<?php

use App\Http\Controllers\Connexion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DirectorAddAccountController;
use App\Models\Session;

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




Route::get('/director', [DirectorController::class, 'index'])->name('profile');
Route::post('/addStudent', [DirectorController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [DirectorController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [DirectorController::class, 'insertResponsable'])->name('addRespForm');

Route::post('/director/addUser', [DirectorAddAccountController::class, 'insertUser'])->name('addUser');
Route::get('/director/accountCreation', [DirectorAddAccountController::class, 'index'])->name('DirectorAccountCreation');

Route::get('/', [Connexion::class, 'show']);

Route::post('/login', [Connexion::class, 'login']);

Route::get('/director_panel', function () {
    return view('director_panel');
});

Route::get('/CreationSession', [SessionController::class, 'index']);

Route::post('/TraitementCreationSession', [SessionController::class, 'executeRequest']);
