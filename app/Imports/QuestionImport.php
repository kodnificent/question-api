<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements OnEachRow, WithHeadingRow
{
    /**
    * @param \Maatwebsite\Excel\Row $row
    */
    public function onRow(Row $row)
    {
        DB::transaction(function () use ($row) {
            $row = $row->toArray();

            // extract only the question attributes needed from the row
            $questionAttributes = array_intersect_key(
                $row,
                array_flip([
                    'question',
                    'is_general',
                    'categories',
                    'point',
                    'icon_url',
                    'duration',
                ])
            );

            $question = Question::create($questionAttributes);

            $choices = [];

            // extract attributes from the 4 choices in the row.
            foreach (range(1,4) as $key) {
                array_push($choices,  [
                    'description' => $row["choice_${key}"],
                    'is_correct_choice' => $row["is_correct_choice_${key}"],
                    'icon_url' => $row["icon_url_${key}"]
                ]);
            }

            $question->choices()->createMany($choices);
        });
    }

    /**
     * Validation rules for each row.
     *
     * @return array
     */
    public function rules()
    {
        // @todo create validation rule for a unique correct choice
        // meaning we can't have more than one correct choices.
        return [
            'question' => ['required', 'string'],
            'is_general' => ['required', 'boolean'],
            'categories' => ['required', 'string'],
            'point' => ['required', 'numeric', 'min:1'],
            'icon_url' => ['nullable', 'url'],
            'duration' => ['required', 'numeric', 'min:1'],
            'choice_1' => ['required', 'string', 'max:250'],
            'is_correct_choice_1' => ['required', 'boolean'],
            'icon_url_1' => ['nullable', 'url'],
            'choice_2' => ['required', 'string', 'max:250'],
            'is_correct_choice_2' => ['required', 'boolean'],
            'icon_url_2' => ['nullable', 'url'],
            'choice_3' => ['required', 'string', 'max:250'],
            'is_correct_choice_3' => ['required', 'boolean'],
            'icon_url_3' => ['nullable', 'url'],
            'choice_4' => ['required', 'string', 'max:250'],
            'is_correct_choice_4' => ['required', 'boolean'],
            'icon_url_4' => ['nullable', 'url'],
        ];
    }
}
