<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Choice as ChoiceRequest;
use App\Http\Resources\Choice as ChoiceResource;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Choice  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function store(ChoiceRequest $request, Question $question)
    {
        $attributes = $request->only(['description', 'is_correct_choice', 'icon_url']);
        $choice = $question->choices()->create($attributes);

        return new ChoiceResource($choice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Choice  $request
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(ChoiceRequest $request, Choice $choice)
    {
        $attributes = $request->only(['description', 'is_correct_choice', 'icon_url']);
        $choice->update($attributes);

        return new ChoiceResource($choice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choice $choice)
    {
        $choice->forceDelete();

        return response()->json([
            'message' => 'Data deleted successfully.',
        ]);
    }
}
