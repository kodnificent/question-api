<?php

namespace Tests\Feature;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanUpdateQuestion()
    {
        $question = Question::factory()->create([
            'question' => 'How old is you?'
        ]);

        $formData = $question->toArray();
        $formData['question'] = 'How old are you?';

        $res = $this->putJson(route('api.questions.update', [ 'question' => $question->id]), $formData);
        $res->assertStatus(201)
            ->assertJson(['question' => $formData['question']]);
    }

    public function testUserCanViewQuestion()
    {
        $question = Question::factory()
            ->has(Choice::factory()->count(4))
            ->create();

        $res = $this->getJson(route('api.questions.show', [ 'question' => $question->id]));

        $res->assertStatus(200)
            ->assertJsonStructure([
                'question',
                'is_general',
                'category',
                'point',
                'icon_url',
                'duration',
                'choices'
            ]);
    }

    public function testUserCanDeleteQuestion()
    {
        $question = Question::factory()
            ->create();

        $res = $this->deleteJson(route('api.questions.destroy', ['question' => $question->id]));
        $res->assertStatus(200);

        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }

    public function testUserCanViewAllQuestions()
    {
        $question = Question::factory()
            ->count(50)
            ->has(Choice::factory()->count(4))
            ->create();

        $res = $this->getJson(route('api.questions.index'));

        $res->dump();
        $res->assertStatus(200);
        $res->assertJsonStructure([
            'data'
        ]);
    }
}
