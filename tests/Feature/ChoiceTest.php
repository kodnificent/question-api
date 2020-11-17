<?php

namespace Tests\Feature;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChoiceTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanUpdateAChoice()
    {
        $choice = Choice::factory()->create();
        $formData = $choice->toArray();
        $formData['description'] = 'New choice description';

        $res = $this->putJson(route('api.choices.update', ['choice' => $choice->id]), $formData);
        $res->assertStatus(200)
            ->assertJson([
                'data' => [
                    'description' => $formData['description'],
                ]
            ]);
    }

    public function testUserCanDeleteAChoice()
    {
        $choice = Choice::factory()->create();
        $res = $this->deleteJson(route('api.choices.destroy', ['choice' => $choice->id]));

        $res->assertStatus(200);

        $this->assertDatabaseMissing('choices', ['id' => $choice->id]);
    }

    public function testUserCanCreateChoice()
    {
        $question = Question::factory()->create();
        $data = [
            'description' => 'USA',
            'is_correct_choice' => true,
            'icon_url' => 'https://myicon.url/icon.svg'
        ];

        $res = $this->postJson(route('api.questions.choices.store', ['question' => $question->id]), $data);

        $res->assertStatus(201)
            ->assertJson([
                'data' => $data
            ]);
    }
}
