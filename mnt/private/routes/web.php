<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

// pour tester la connexion à la db
Route::get('/test', function () {
    Session::insertSession();

    return "hello";
});

Route::get('/CreationSession', [SessionController::class, 'index']);
