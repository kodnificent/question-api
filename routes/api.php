<?php

use App\Http\Controllers\API\ChoiceController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->prefix('v1')->group(function () {
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('questions.choices', ChoiceController::class)->only([
        'store',
    ]);
    Route::apiResource('choices', ChoiceController::class)->only([
        'update', 'destroy',
    ]);
});
