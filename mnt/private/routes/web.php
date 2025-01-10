<?php

// Navigation
use App\Http\Controllers\Connexion;
use App\Http\Controllers\EditProfile;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Unregistered;

// SuperAdmin
use App\Http\Controllers\addCompController;
use App\Http\Controllers\addAptController;
use App\Http\Controllers\UpdtAptController;
use App\Http\Controllers\UpdtCompController;

// Director
use App\Http\Controllers\Director;
use App\Http\Controllers\LevelConfirmation;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\AddTraining;

// Training Manager
use App\Http\Controllers\Manager;
use App\Http\Controllers\SessionManagement;
use App\Http\Controllers\SkillsManagement;
use App\Http\Controllers\TraineeList;

// Trainer
use App\Http\Controllers\Initiator;
use App\Http\Controllers\SessionRating;
use App\Http\Controllers\TrainingDetails;

//BACK-END Controllers
use App\Http\Controllers\TraineeListFormation;
use App\Http\Controllers\InitiatorListFormation;
use App\Http\Controllers\SkillsDetails;
use App\Http\Controllers\Trainee;
use App\Http\Controllers\SessionDetails;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditUser;


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



//_______________________NAVIGATION_______________________


//page for not connected users
Route::middleware(['isNotConnected'])->group(function () {
    Route::get('', [Connexion::class, 'show']);
    Route::get('connexion', [Connexion::class, 'show'])->name('connexion');
});


//page for connected users
Route::middleware(['isConnected'])->group(function () {

    Route::get('profile', [Profile::class, 'show'])->name('profile');
    Route::get('edit-profile', [EditProfile::class, 'show'])->name('edit-profile');
    Route::get('non-inscrit', [Unregistered::class, 'show'])->name('non-inscrit');

    // SuperAdmin
    Route::middleware(['isSuperAdmin'])->group(function () {
        Route::get('superadmin', [addCompController::class, 'show'])->name('superadmin.addcomp');
        Route::get('/superadmin/ajoutaptitude', [addAptController::class, 'show'])->name('superadmin.addapt');
        Route::get('/superadmin/modifcompetence', [UpdtCompController::class, 'show'])->name('superadmin.updtcomp');
        Route::get('/superadmin/modifaptitude', [UpdtAptController::class, 'show'])->name('superadmin.updtapt');
    });
    // Director
    Route::middleware(['isDirector'])->group(function () {
        Route::get('directeur', [Director::class, 'show'])->name('directeur');
        Route::get('directeur/gestion-formation', [Director::class, 'show'])->name('directeur.gestion-formation');
        Route::get('directeur/valider-niveau', [LevelConfirmation::class, 'show'])->name('directeur.valider-niveau');
        Route::get('directeur/gestion-utilisateur', [UserManagement::class, 'show'])->name('directeur.gestion-utilisateur');
        Route::get('directeur/ajouter-utilisateur', [AddUser::class, 'show'])->name('directeur.ajouter-utilisateur');
        Route::get('directeur/ajouter-formation', [AddTraining::class, 'show'])->name('directeur.ajouter-formation');
    });
    // Training Manager
    Route::middleware(['isManager'])->group(function () {
        Route::get('responsable-formation', [Manager::class, 'show'])->name('responsable');
        Route::match(array('GET', 'POST'), 'responsable-formation/gestion-seance', [SessionManagement::class, 'show']);    //Creation session
        Route::get('responsable-formation/gestion-aptitude', [SkillsManagement::class, 'show'])->name('responsable.gestion-aptitude');
        Route::get('responsable-formation/gestion-aptitude-eleve/{userId}', [SkillsDetails::class, 'showTraineeSkills'])->name('responsable.gestion-aptitude-eleve');
        Route::get('responsable-formation/details-formation', [TrainingDetails::class, 'show'])->name('responsable.details-formation');

    });
    // Trainer
    Route::middleware(['isInitiator'])->group(function () {
        Route::get('initiateur', [Initiator::class, 'show'])->name('initiateur');
        Route::get('initiateur/evaluation-seance', [SessionRating::class, 'show'])->name('initiateur.evaluation-seance');
        Route::get('initiateur/liste-eleves', [TrainingDetails::class, 'show'])->name('initiateur.liste-eleves');
        Route::post('initiateur/liste-eleves', [TraineeList::class, 'show'])->name('initiateur.liste-eleves');
        Route::post('initiateur/evaluation-seance', [SessionRating::class, 'show']);
        Route::post('/traitement_validation_aptitudes', [SessionRating::class, 'updateStudentSkillForSession']);
        Route::get('initiateur/gestion-aptitude', [SkillsManagement::class, 'showInitiator'])->name('initiateur.gestion-aptitude');
        Route::get('initiateur/gestion-aptitude-eleve/{userId}', [SkillsDetails::class, 'showTraineeSkills'])->name('initiateur.gestion-aptitude-eleve');
    });
    // Trainee
    Route::middleware(['isStudent'])->group(function () {
        Route::get('eleve', [Trainee::class, 'show'])->name('eleve');
        Route::get('eleve/details-seance', [SessionDetails::class, 'show'])->name('eleve.details-seance');
        Route::get('eleve/details-aptitudes', [SkillsDetails::class, 'show'])->name('eleve.details-aptitudes');
    });
});

//_______________________BACK-END_______________________

Route::post('login', [Connexion::class, 'login'])->name('login');
Route::post('logout', [Profile::class, 'logout'])->name('logout');
Route::post('edit-profile', [EditProfile::class, 'edit'])->name('edit-profile');
Route::post('mdp-perdu', [Connexion::class, 'recupMdp'])->name('mdp-perdu');

//SuperAdmin
Route::post('/superadmin/ajoutcompetence/form', [addCompController::class, 'add'])->name('superadmin.addcompform');
Route::post('/superadmin/ajoutaptitude/form', [addAptController::class, 'add'])->name('superadmin.addaptform');
Route::post('/superadmin/modifcompetence/form', [UpdtCompController::class, 'updt'])->name('superadmin.updtcompform');
Route::post('/superadmin/modifaptitude/form', [UpdtAptController::class, 'updt'])->name('superadmin.updtaptform');

// Director
Route::post('directeur/gestion-eleve', [TraineeListFormation::class, 'show'])->name('directeur.gestion-eleve');
Route::post('directeur/ajoute-eleve-formation', [TraineeListFormation::class, 'add'])->name('directeur.ajoute-eleve-formation');
Route::post('directeur/supprime-eleve-formation', [TraineeListFormation::class, 'remove'])->name('directeur.supprime-eleve-formation');

Route::post('directeur/gestion-initiateur', [InitiatorListFormation::class, 'show'])->name('directeur.gestion-initiateur');
Route::post('directeur/ajoute-initiateur-formation', [InitiatorListFormation::class, 'add'])->name('directeur.ajoute-initiateur-formation');
Route::post('directeur/supprime-initiateur-formation', [InitiatorListFormation::class, 'remove'])->name('directeur.supprime-initiateur-formation');

Route::post('directeur/ajoute-formation', [AddTraining::class, 'add'])->name('directeur.ajoute-formation');
Route::post('directeur/supprimer-formation', [Director::class, 'delete'])->name('directeur.supprimer-formation');
Route::post('directeur/gestion-responsable', [Director::class, 'editResponsable'])->name('directeur.gestion-responsable');

Route::post('directeur/modifier-utilisateur', [EditUser::class, 'show'])->name('directeur.modifier-utilisateur');
Route::post('editUser', [EditUser::class, 'edit'])->name('editUser');
Route::post('archiveuser', [EditUser::class, 'archive'])->name('archiveuser');
Route::post('addStudent', [AddUser::class, 'insertUser'])->name('addStudent');

Route::get('directeur/generer-csv', [Director::class, 'generateCsv'])->name('director.generer-csv');

Route::post('/director/levelconfirmation', [LevelConfirmation::class, 'accept'])->name('acceptStudent');

// Training Manager
Route::post('responsable-formation/TraitementCreationSession', [SessionManagement::class, 'executeRequest'])->name('sessionManager.traitementCreationSession');

// Trainer
