<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Question extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanStoreQuestion()
    {
        $response = $this->postJson(route('api.questions.store'), [
            'question' => 'In which country is the humble ‘thumbs up’ gesture considered a great insult?',
            'is_general' => true,
            'categories' => 'physcometric',
            'point' => 5,
            // 'icon_url' => null,
            'duration' => 10,
            'choices' => [
                [
                    'choice' => 'USA',
                    'is_correct_choice' => false,
                ],
                [
                    'choice' => 'IRAN',
                    'is_correct_choice' => true,
                ],
                [
                    'choice' => 'PAKISTAN',
                    'is_correct_choice' => true
                ],
                [
                    'choice' => 'CHILE',
                    'is_correct_choice' => FALSE,
                ]
            ]
        ]);
        $response->dump();

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }
}
