<?php

use App\Http\Controllers\Connexion;
use App\Http\Controllers\edtInitiateurController;
use App\Http\Controllers\ttInitiatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
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

//NAVIGATION

Route::get('/', [Connexion::class, 'show']);                                                                    //Connection
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');                                   //Profile
Route::get('SessionManager/CreationSession', [SessionController::class, 'index']);                              //Creation session


//BACK-END

//connection
Route::post('/login', [Connexion::class, 'login']);


//profil
Route::post('/addStudent', [ProfileController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [ProfileController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [ProfileController::class, 'insertResponsable'])->name('addRespForm');
Route::post('/addUser', [ProfileController::class, 'insertUser'])->name('addUser');


Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest']);


Route::get('/edt', [ttInitiatorController::class, 'tt']);

