<?php

use App\Http\Controllers\Connexion;
use App\Http\Controllers\edtInitiateurController;
use App\Http\Controllers\ttInitiatorController;
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

//NAVIGATION

Route::get('/', [Connexion::class, 'show']);                                                                    //Connection
Route::get('/director', [DirectorController::class, 'index'])->name('director');                                   //director
Route::get('SessionManager/CreationSession', [SessionController::class, 'index']);                              //Creation session





//BACK-END

//connection
Route::post('/login', [Connexion::class, 'login']);


//director

Route::post('/director/addStudent', [DirectorController::class, 'insertStudent'])->name('addStudent');
Route::post('/director/addTeacher', [DirectorController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/director/addRespForm', [DirectorController::class, 'insertResponsable'])->name('addRespForm');


Route::post('/director/addUser', [DirectorAddAccountController::class, 'insertUser'])->name('addUser');
Route::get('/director/accountCreation', [DirectorAddAccountController::class, 'index'])->name('DirectorAccountCreation');

Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest']);


Route::get('/edt', [ttInitiatorController::class, 'tt']);

