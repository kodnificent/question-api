<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Question extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function rules(Request $request)
    {
        return $request->method('POST') ? $this->creationRules() : $this->updateRules();
    }

    /**
     * Validation rules for store requests.
     *
     * @return array
     */
    public function creationRules()
    {
        return [
            'file' => ['required', 'questions_file', 'mimes:xlsx']
        ];
    }

    /**
     * Validation rules for update requests.
     *
     * @return array
     */
    public function updateRules()
    {
        return [
            'question' => ['required', 'string'],
            'is_general' => ['required', 'boolean'],
            'categories' => ['required', 'string'],
            'point' => ['required', 'numeric', 'min:1'],
            'icon_url' => ['nullable', 'url'],
            'duration' => ['required', 'numeric', 'min:1'],
        ];
    }
}
