<?php

namespace Tests\Feature;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile as IlluminateUploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanViewAllQuestions()
    {
        Question::factory()
            ->count(50)
            ->has(Choice::factory()->count(4))
            ->create();

        $res = $this->getJson(route('api.questions.index'));

        $res->assertStatus(200);
        $res->assertJsonStructure([
            'data'
        ]);
    }

    public function testUserCanGetAQuestionAndItsChoices()
    {
        $question = Question::factory()
            ->has(Choice::factory()->count(4))
            ->create();

        $res = $this->getJson(route('api.questions.show', [ 'question' => $question->id]));

        $res->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'question',
                    'is_general',
                    'category',
                    'point',
                    'icon_url',
                    'duration',
                    'choices'
                ]
            ]);
    }

    public function testUserCanUpdateAQuestion()
    {
        $question = Question::factory()->create([
            'question' => 'How old is you?'
        ]);

        $formData = $question->toArray();
        $formData['question'] = 'How old are you?';

        $res = $this->putJson(route('api.questions.update', [ 'question' => $question->id]), $formData);
        $res->assertStatus(200)
            ->assertJson([
                'data' => [
                    'question' => $formData['question'],
                ],
            ]);
    }

    public function testUserCanDeleteAQuestion()
    {
        $question = Question::factory()
            ->create();

        $res = $this->deleteJson(route('api.questions.destroy', ['question' => $question->id]));
        $res->assertStatus(200);

        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }

    public function testUserCanStoreQuestion()
    {
        $file = IlluminateUploadedFile::createFromBase(
            (new UploadedFile(
                base_path('test-quest.xlsx'),
                'test-quest.xlsx',
            ))
        );
        $res = $this->postJson(route('api.questions.store'), [
            'question_file' => $file
        ]);

        $res->assertStatus(200);
    }
}
