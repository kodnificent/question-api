<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->boolean('is_general');
            $table->char('categories');
            $table->integer('point');
            $table->string('icon_url');
            $table->integer('duration');
            $table->string('choice_1')->nullable();
            $table->boolean('is_correct_choice_1')->default(false);
            $table->string('icon_url_1')->nullable();
            $table->string('choice_2')->nullable();
            $table->boolean('is_correct_choice_2')->default(false);
            $table->string('icon_url_2')->nullable();
            $table->string('choice_3')->nullable();
            $table->boolean('is_correct_choice_3')->default(false);
            $table->string('icon_url_3')->nullable();
            $table->string('choice_4')->nullable();
            $table->boolean('is_correct_choice_4')->default(false);
            $table->string('icon_url_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
