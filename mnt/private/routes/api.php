<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ApiController;

// Routes pour les clubs
Route::get('/clubs', [ApiController::class, 'getClubs']);
Route::get('/clubs/{id}', [ApiController::class, 'getClub']);

// Routes pour les compétences
Route::get('/competences', [ApiController::class, 'getCompetences']);
Route::get('/competences/{id}', [ApiController::class, 'getCompetence']);

// Routes pour les formations
Route::get('/formations', [ApiController::class, 'getFormations']);
Route::get('/formations/{id}', [ApiController::class, 'getFormation']);

// Routes pour les utilisateurs
Route::get('/users', [ApiController::class, 'getUsers']);
Route::get('/users/{id}', [ApiController::class, 'getUser']);

// Routes pour les leçons
Route::get('/lessons', [ApiController::class, 'getLessons']);
Route::get('/lessons/{id}', [ApiController::class, 'getLesson']);

// Routes dynamiques pour créer, mettre à jour et supprimer des entités
Route::post('/{modelName}', [ApiController::class, 'createEntity']);
Route::put('/{modelName}/{id}', [ApiController::class, 'updateEntity']);
Route::delete('/{modelName}/{id}', [ApiController::class, 'deleteEntity']);

