<?php

use App\Http\Controllers\Connexion;
use App\Http\Controllers\edtInitiateurController;
use App\Http\Controllers\ttInitiatorController;
use App\Http\Controllers\ttStudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\supAdminController;
use App\Http\Controllers\addAptController;
use App\Http\Controllers\addCompController;
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

Route::get('/', function () {
    return 'bonjour';
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/test', function () {
    
    return 'au revoir';
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/addStudent', [ProfileController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [ProfileController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [ProfileController::class, 'insertResponsable'])->name('addRespForm');
Route::post('/addUser', [ProfileController::class, 'insertUser'])->name('addUser');
Route::get('/test', function () {

    return 'au revoir';
});


Route::get('/', [Connexion::class, 'show']);

Route::post('/login', [Connexion::class, 'login']);

Route::get('/director_panel', function () { return view('director_panel');});
Route::get('/teacher_panel', function () { return view('teacher_panel');});
Route::get('/manager_panel', function () { return view('manager_panel');});
Route::get('/student_panel', function () { return view('student_panel');});

Route::get('/class_details', function () { return view('class_details');});
Route::get('/account_management', function () { return view('account_management');});

Route::get('SessionManager/CreationSession', [SessionController::class, 'index']);

Route::post('SessionManager/TraitementCreationSession', [SessionController::class, 'executeRequest']);

Route::get('director_panel', function(){
    return view('director_panel');
});

Route::get('/initiateur/edt', [ttInitiatorController::class, 'show']);
Route::get('/eleve/edt', [ttStudentController::class, 'show']);
Route::get('/superadmin', [supAdminController::class, 'show'])->name('superadmin');
Route::get('/superadmin/ajoutcompetence', [addCompController::class, 'show'])->name('superadmin.addcomp');
Route::post('/superadmin/ajoutcompetence/form', [addCompController::class, 'add'])->name('superadmin.addcompform');
Route::get('/superadmin/ajoutaptitude', [addAptController::class, 'show'])->name('superadmin.addapt');
