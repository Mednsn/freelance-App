<?php

use App\Http\Api\Auth\AuthentificationApi;
use App\Http\Api\CandidatureControllerApi;
use App\Http\Api\CategoryControllerApi;
use App\Http\Api\EvaluationControllerApi;
use App\Http\Api\ExperienceControllerApi;
use App\Http\Api\SkillControllerApi;
use App\Http\Api\TechnologieControllerApi;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageControllerApi;
use App\Http\Controllers\MissionControllerApi;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\ClientMiddleware;
use App\Http\Middleware\FreelanceMiddleware;
use App\Http\Middleware\AdminMiddleware;


Route::post('/register', [AuthentificationApi::class, 'register']);
Route::post('/login', [AuthentificationApi::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/reviews', [EvaluationControllerApi::class,'store']);
    Route::get('/reviews/{user_id}/average', [EvaluationControllerApi::class,'moyenneAVG']);
    Route::post('/messages', [MessageControllerApi::class,'store']);
    Route::get('/messages/{user_id}', [MessageControllerApi::class,'conversation']);


    Route::get('/logout', [AuthentificationApi::class, 'logout']);
});






Route::middleware(['auth:sanctum', ClientMiddleware::class])->group(function () {

    Route::post('/missions', [MissionControllerApi::class, 'store']);
    Route::put('/missions/{id}', [MissionControllerApi::class, 'update']);
    Route::delete('/missions/{id}', [MissionControllerApi::class, 'destroy']);

    Route::put('/candidatures/{id}', [CandidatureControllerApi::class,'updateStatus']);
});

Route::middleware(['auth:sanctum', FreelanceMiddleware::class])->group(function () {
    Route::post('/missions/{id}/apply', [CandidatureControllerApi::class, 'store']);
    Route::get('/missions/my-applications', [CandidatureControllerApi::class, 'index']);
    Route::get('/my-applications', [CandidatureControllerApi::class,'index']);
    Route::post('/experience', [ExperienceControllerApi::class,'store']);
    Route::get('/experience', [ExperienceControllerApi::class,'myExperience']);
});

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::post('/categories', [CategoryControllerApi::class, 'store']);
    Route::post('/skills', [SkillControllerApi::class, 'store']);
    Route::post('/technologies', [TechnologieControllerApi::class, 'store']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});
