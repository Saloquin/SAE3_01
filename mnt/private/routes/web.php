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
    return 'bonjour';
});

Route::get('/test', function () {
    
    return 'au revoir';
});

Route::get('/welcome', function(){
    return view('welcome');
});

// pour tester la connexion à la db
Route::get('/test', function () {
    Session::insertSession(1, '07-01-2025', 1, null, 2);

    return "hello";
});

Route::get('/CreationSession', [SessionController::class, 'index']);

Route::post('/TraitementCreationSession', [SessionController::class, 'executeRequest']);
