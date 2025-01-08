<?php

use App\Http\Controllers\Connexion;
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


Route::get('/home', function () {
    return view('home');
});

Route::get('/test', function () {

    return 'au revoir';
});


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/addStudent', [ProfileController::class, 'insertStudent'])->name('addStudent');
Route::post('/addTeacher', [ProfileController::class, 'insertTeacher'])->name('addTeacher');
Route::post('/addRespForm', [ProfileController::class, 'insertResponsable'])->name('addRespForm');
Route::post('/addUser', [ProfileController::class, 'insertUser'])->name('addUser');


Route::get('/', [Connexion::class, 'show']);

Route::post('/login', [Connexion::class, 'login']);

Route::get('/director_panel', function () { return view('director_panel');});
Route::get('/teacher_panel', function () { return view('teacher_panel');});
Route::get('/manager_panel', function () { return view('manager_panel');});
Route::get('/student_panel', function () { return view('student_panel');});
Route::get('/class_details_student', function () { return view('class_details_student');});
Route::get('/class_details_manager', function () { return view('class_details_manager');});
Route::get('/account_management', function () { return view('account_management');});
Route::get('/day_details', function () { return view('day_details');});
Route::get('/users_list', function () { return view('users_list');});
Route::get('/class_management', function () { return view('class_management');});
Route::get('/student_report', function () { return view('student_report');});
Route::get('/formation_report', function () { return view('formation_report');});
Route::get('/teachers_list', function () { return view('teachers_list');});
Route::get('/students_list', function () { return view('students_list');});
Route::get('/user_creation', function () { return view('user_creation');});
Route::get('/formation_creation', function () { return view('formation_creation');});
Route::get('/formation_validation', function () { return view('formation_validation');});
Route::get('/formation_management', function () { return view('formation_management');});

Route::get('/CreationSession', [SessionController::class, 'index']);

Route::post('/TraitementCreationSession', [SessionController::class, 'executeRequest']);
