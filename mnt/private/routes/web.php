<?php

use App\Http\Controllers\Connexion;
use App\Http\Controllers\TraineeListFormation;
use App\Http\Controllers\InitiatorListFormation;
use App\Http\Controllers\ttInitiatorController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Director;
use App\Http\Controllers\LevelConfirmation;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\AddTraining;
use App\Http\Controllers\EditTraining;
use App\Http\Controllers\Manager;
use App\Http\Controllers\SessionManagement;
use App\Http\Controllers\SkillsManagement;
use App\Http\Controllers\TrainingDetails;
use App\Http\Controllers\Initiator;
use App\Http\Controllers\SessionRating;
use App\Http\Controllers\TraineeList;
use App\Http\Controllers\Trainee;
use App\Http\Controllers\SessionDetails;
use App\Http\Controllers\SkillsDetails;
use Illuminate\Support\Facades\Route;
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

Route::get('', [Connexion::class, 'show']);
Route::get('connexion', [Connexion::class, 'show'])->name('connexion');   //Connection
Route::get('profile', [Profile::class, 'show'])->name('profile');

// Admin
Route::get('admin/gestion-competences', [SkillsList::class, 'show']);
Route::get('admin/details-competence', [AbilitiesList::class, 'show']);
Route::post('admin/details-competence', [AbilitiesList::class, 'show']);
Route::get('admin/ajouter-competence', [AddSkill::class, 'show']);
Route::get('admin/ajouter-aptitude', [AddAbility::class, 'show']);

// Director
Route::get('directeur', [Director::class, 'show'])->name('directeur.show'); // TODO : add navbar in controller
Route::get('directeur/gestion-formation', [Director::class, 'show'])->name('directeur.gestion-formation');
Route::get('directeur/valider-niveau', [LevelConfirmation::class, 'show'])->name('directeur.valider-niveau');
Route::get('directeur/gestion-utilisateur', [UserManagement::class, 'show'])->name('directeur.gestion-utilisateur');
Route::get('directeur/ajouter-utilisateur', [AddUser::class, 'show'])->name('directeur.ajouter-utilisateur');
Route::get('directeur/ajouter-formation', [AddTraining::class, 'show'])->name('directeur.ajouter-formation');
Route::get('directeur/modifier-formation', [EditTraining::class, 'show'])->name('directeur.modifier-formation'); // TODO : add navbar in controller


// Training Manager
Route::get('responsable-formation', [Manager::class, 'show'])->name('responsable.show'); // TODO : add navbar in controller
Route::get('responsable-formation/gestion-seance', [SessionManagement::class, 'show'])->name('responsable.gestion-seance');    //Creation session
Route::get('responsable-formation/gestion-aptitude', [SkillsManagement::class, 'show'])->name('responsable.gestion-aptitude');
Route::get('responsable-formation/details-formation', [TrainingDetails::class, 'show'])->name('responsable.details-formation'); // TODO : add navbar in controller

// Trainer
Route::get('initiateur', [Initiator::class, 'show'])->name('initiateur.show'); // TODO : add navbar in controller
Route::get('initiateur/evaluation-seance', [SessionRating::class, 'show'])->name('initiateur.evaluation-seance');
Route::get('initiateur/liste-eleves', [TraineeList::class, 'show'])->name('initiateur.liste-eleves');
Route::post('initiateur/evaluation-seance', [SessionRating::class, 'show']);

// Trainee
Route::get('eleve', [Trainee::class, 'show'])->name('eleve.show'); // TODO : add navbar in controller
Route::get('eleve/details-seance', [SessionDetails::class, 'show'])->name('eleve.details-seance');
Route::get('eleve/details-aptitudes', [SkillsDetails::class, 'show'])->name('eleve.details-aptitudes'); // TODO : add navbar in controller

Route::get('/edt', [ttInitiatorController::class, 'tt'])->name('ttInitiatorController.tt');
// BACK-END

// Connexion et authentification
Route::post('/login', [Connexion::class, 'login'])->name('login');
Route::post('/logout', [Profile::class, 'logout'])->name('logout');

// Director routes
Route::post('addStudent', [AddUser::class, 'insertUser'])->name('addStudent');

Route::post('directeur/gestion-eleve', [TraineeListFormation::class, 'show'])->name('directeur.gestion-eleve');
Route::post('directeur/ajoute-eleve-formation', [TraineeListFormation::class, 'add'])->name('directeur.ajoute-eleve-formation');
Route::post('directeur/supprime-eleve-formation', [TraineeListFormation::class, 'remove'])->name('directeur.supprime-eleve-formation');

Route::post('directeur/gestion-initiateur', [InitiatorListFormation::class, 'show'])->name('directeur.gestion-initiateur');
Route::post('directeur/ajoute-initiateur-formation', [InitiatorListFormation::class, 'add'])->name('directeur.ajoute-initiateur-formation');
Route::post('directeur/supprime-initiateur-formation', [InitiatorListFormation::class, 'remove'])->name('directeur.supprime-initiateur-formation');

Route::post('directeur/ajoute-formation', [AddTraining::class, 'add'])->name('directeur.ajoute-formation');

Route::post('directeur/gestion-responsable', [Director::class, ''])->name('directeur.gestion-responsable');

Route::get('/director/accountCreation', [DirectorAddAccountController::class, 'index'])->name('DirectorAccountCreation');
Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest'])->name('sessionManager.traitementCreationSession');

// Test route (ttInitiatorController)
