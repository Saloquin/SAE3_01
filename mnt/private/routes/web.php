<?php

use App\Http\Controllers\AbilitiesList;
use App\Http\Controllers\AddAbility;
use App\Http\Controllers\AddSkill;
use App\Http\Controllers\Connexion;
use App\Http\Controllers\SkillsList;
use App\Http\Controllers\Trainee;
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
use App\Http\Controllers\SessionDetails;
use App\Http\Controllers\SkillsDetails;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DirectorAddAccountController;
use App\Models\Session;
use App\Http\Controllers\supAdminController;
use App\Http\Controllers\addAptController;
use App\Http\Controllers\addCompController;
use App\Http\Controllers\EditProfile;
use App\Http\Controllers\EditUser;
use App\Http\Controllers\TraineeList;
use App\Http\Controllers\UpdtAptController;
use App\Http\Controllers\UpdtCompController;

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

Route::get('edit-profile', [EditProfile::class, 'show'])->name('edit-profile');
// Admin
Route::get('admin', [SkillsList::class, 'show']);
Route::get('admin/details-competence', [AbilitiesList::class, 'show']);
Route::post('admin/details-competence', [AbilitiesList::class, 'show']);
Route::get('admin/ajouter-competence', [AddSkill::class, 'show']);
Route::get('admin/ajouter-aptitude', [AddAbility::class, 'show']);


// Director
Route::get('directeur', [Director::class, 'show'])->name('directeur');
Route::get('directeur/gestion-formation', [Director::class, 'show'])->name('directeur.gestion-formation');
Route::get('directeur/valider-niveau', [LevelConfirmation::class, 'show'])->name('directeur.valider-niveau');
Route::get('directeur/gestion-utilisateur', [UserManagement::class, 'show'])->name('directeur.gestion-utilisateur');
Route::get('directeur/ajouter-utilisateur', [AddUser::class, 'show'])->name('directeur.ajouter-utilisateur');
Route::get('directeur/ajouter-formation', [AddTraining::class, 'show'])->name('directeur.ajouter-formation');
Route::get('directeur/modifier-formation', [EditTraining::class, 'show'])->name('directeur.modifier-formation');



// Training Manager
Route::get('responsable-formation', [Manager::class, 'show'])->name('responsable.show');
Route::match(array('GET','POST'), 'responsable-formation/gestion-seance', [SessionManagement::class, 'show']);    //Creation session
Route::get('responsable-formation/gestion-aptitude', [SkillsManagement::class, 'show'])->name('responsable.gestion-aptitude');
Route::get('responsable-formation/details-formation', [TrainingDetails::class, 'show'])->name('responsable.details-formation');
Route::post('responsable-formation/details-formation', [TrainingDetails::class, 'show'])->name('responsable.details-formation');

// Trainer
Route::get('initiateur', [Initiator::class, 'show'])->name('initiateur.show');
Route::get('initiateur/evaluation-seance', [SessionRating::class, 'show'])->name('initiateur.evaluation-seance');
Route::get('initiateur/liste-eleves', [TrainingDetails::class, 'show'])->name('initiateur.liste-eleves');
Route::post('initiateur/liste-eleves', [TraineeList::class, 'show'])->name('initiateur.liste-eleves');
Route::post('initiateur/evaluation-seance', [SessionRating::class, 'show']);
Route::post('/traitement_validation_aptitudes', [SessionRating::class, 'updateStudentSkillForSession']); // ne pas supprimer PITIÉ

// Trainee
Route::get('eleve', [Trainee::class, 'show'])->name('eleve.show');
Route::get('eleve/details-seance', [SessionDetails::class, 'show'])->name('eleve.details-seance');
Route::get('eleve/details-aptitudes', [SkillsDetails::class, 'show'])->name('eleve.details-aptitudes');

//Route::get('/edt', [ttInitiatorController::class, 'tt'])->name('ttInitiatorController.tt');



//BACK-END

// Connexion et authentification
Route::post('/login', [Connexion::class, 'login'])->name('login');
Route::post('/logout', [Profile::class, 'logout'])->name('logout');
//connexion
Route::post('/login', [Connexion::class, 'login']);

// Director routes
Route::post('addStudent', [AddUser::class, 'insertUser'])->name('addStudent');

Route::post('directeur/gestion-eleve', [TraineeListFormation::class, 'show'])->name('directeur.gestion-eleve');
Route::post('directeur/ajoute-eleve-formation', [TraineeListFormation::class, 'add'])->name('directeur.ajoute-eleve-formation');
Route::post('directeur/supprime-eleve-formation', [TraineeListFormation::class, 'remove'])->name('directeur.supprime-eleve-formation');

Route::post('directeur/gestion-initiateur', [InitiatorListFormation::class, 'show'])->name('directeur.gestion-initiateur');
Route::post('directeur/ajoute-initiateur-formation', [InitiatorListFormation::class, 'add'])->name('directeur.ajoute-initiateur-formation');
Route::post('directeur/supprime-initiateur-formation', [InitiatorListFormation::class, 'remove'])->name('directeur.supprime-initiateur-formation');

Route::post('directeur/ajoute-formation', [AddTraining::class, 'add'])->name('directeur.ajoute-formation');
Route::post('directeur/modifier-utilisateur', [EditUser::class, 'show'])->name('directeur.modifier-utilisateur');

Route::post('directeur/gestion-responsable', [Director::class, 'editResponsable'])->name('directeur.gestion-responsable');


Route::post('directeur/supprimer-formation', [Director::class, 'delete'])->name('directeur.supprimer-formation');

// Profile routes
Route::post('edit-profile', [EditProfile::class, 'edit'])->name('edit-profile');



//Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest'])->name('sessionManager.traitementCreationSession');


Route::post('responsable-formation/TraitementCreationSession', [SessionManagement::class, 'executeRequest'])->name('sessionManager.traitementCreationSession');



//Superadmin
Route::get('superadmin', [addCompController::class, 'show'])->name('superadmin.addcomp');
Route::get('/superadmin/ajoutaptitude', [addAptController::class, 'show'])->name('superadmin.addapt');
Route::post('/superadmin/ajoutcompetence/form', [addCompController::class, 'add'])->name('superadmin.addcompform');
Route::post('/superadmin/ajoutaptitude/form', [addAptController::class, 'add'])->name('superadmin.addaptform');
Route::get('/superadmin/modifcompetence', [UpdtCompController::class, 'show'])->name('superadmin.updtcomp');
Route::get('/superadmin/modifaptitude', [UpdtAptController::class, 'show'])->name('superadmin.updtapt');
Route::post('/superadmin/modifcompetence/form', [UpdtCompController::class, 'updt'])->name('superadmin.updtcompform');
Route::post('/superadmin/modifaptitude/form', [UpdtAptController::class, 'updt'])->name('superadmin.updtaptform');


/* Route::get('/superadmin/details-competence', [AbilitiesList::class, 'show']);
Route::post('/superadmin/details-competence', [AbilitiesList::class, 'show']); */

Route::get('director_panel', function(){
    return view('director_panel');
});

Route::get('/edt', [ttInitiatorController::class, 'tt']);

Route::get('/tt', function(){
    return view('ttInitiatorView');
});


Route::post('responsable-formation/TraitementCreationSession', [SessionManagement::class, 'executeRequest']);
Route::post('/director/levelconfirmation', [LevelConfirmation::class, 'accept'])->name('acceptStudent');
