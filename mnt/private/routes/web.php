<?php

use App\Http\Controllers\Connexion;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Connexion::class, 'show']);

Route::post('/login', [Connexion::class, 'login']);

Route::get('/director_panel', function () {
    return view('director_panel');
});

Route::get('/test', function () {

    return 'au revoir';
});

Route::get('/welcome', function(){
    return view('welcome');
});
