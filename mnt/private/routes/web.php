<?php

use App\Http\Controllers\Connexion;
use App\Http\Controllers\edtInitiateurController;
use App\Http\Controllers\ttInitiatorController;
use App\Http\Controllers\trainee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\initiator;
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

Route::get('', [Connexion::class, 'show']);   //Connection
Route::get('profile', [Profile::class, 'show']);

// Director
Route::get('directeur', [Director::class, 'show']);
Route::get('directeur/gestion-formation', [Director::class, 'show']);
Route::get('directeur/valider-niveau', [LevelConfirmation::class, 'show']);
Route::get('directeur/gestion-utilisateur', [UserManagement::class, 'show']);
Route::get('directeur/ajouter-utilisateur', [AddUser::class, 'show']);
Route::get('directeur/ajouter-formation', [AddTraining::class, 'show']);
Route::get('directeur/modifier-formation', [EditTraining::class, 'show']);

// Training Manager
Route::get('responsable-formation', [Manager::class, 'show']);
Route::get('responsable-formation/gestion-seance', [SessionManagement::class, 'show']);    //Creation session
Route::get('responsable-formation/gestion-aptitude', [SkillsManagement::class, 'show']);
Route::get('responsable-formation/details-formation', [TrainingDetails::class, 'show']);

// Trainer
Route::get('initiateur', [Initiator::class, 'show']);
Route::get('initiateur/evaluation-seance', [SessionRating::class, 'show']);
Route::get('initiateur/liste-eleves', [TraineeList::class, 'show']);

// Trainee
Route::get('eleve', [Trainee::class, 'show']);
Route::get('eleve/details-seance', [SessionDetails::class, 'show']);
Route::get('eleve/details-aptitudes', [SkillsDetails::class, 'show']);

//BACK-END

//connection
Route::post('/login', [Connexion::class, 'login']);

//director

Route::post('/addStudent', [DirectorController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [DirectorController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [DirectorController::class, 'insertResponsable'])->name('addRespForm');


Route::post('/director/addUser', [DirectorAddAccountController::class, 'insertUser'])->name('addUser');
Route::get('/director/accountCreation', [DirectorAddAccountController::class, 'index'])->name('DirectorAccountCreation');

Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest']);


Route::get('/initiateur/edt', [ttInitiatorController::class, 'show']);
Route::get('/eleve/edt', [ttStudentController::class, 'show']);

