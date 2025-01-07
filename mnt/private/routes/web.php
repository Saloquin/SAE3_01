<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view(view: 'welcome');
});


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/addStudent', [ProfileController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [ProfileController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [ProfileController::class, 'insertResponsable'])->name('addRespForm');
Route::post('/addUser', [ProfileController::class, 'insertUser'])->name('addUser');

Route::get('/CreationSession', [SessionController::class, 'index']);
Route::post('/TraitementCreationSession', [SessionController::class, 'executeRequest']);
