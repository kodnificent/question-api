<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question as QuestionRequest;
use App\Http\Resources\Question as QuestionResource;
use App\Imports\QuestionImport;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->query('categories');

        $questions = Question::when($categories, function ($query, $categories) {
            return $query->where('categories', $categories);
        })->orderBy('id', 'desc')->simplePaginate();

        return response()->json(QuestionResource::collection($questions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Question  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        Excel::import(new QuestionImport, $request->file('questions_file'));

        return response()->json([
            'message' => 'Questions imported successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response()->json(new QuestionResource($question->load('choices')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Question  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->only([
            'question',
            'is_general',
            'categories',
            'point',
            'icon_url',
            'duration',
        ]);

        $question->update($data);

        return response()->json(new QuestionResource($question), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->forceDelete();

        return response()->json([
            'message' => 'Data deleted successfully.',
        ]);
    }
}
