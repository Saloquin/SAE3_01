<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
