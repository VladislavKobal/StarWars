<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PeopleController;
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

Route::get('/peoples/search/{search?}', [PeopleController::class, 'index']);
Route::get('/peoples/search/{search?}/homeworld/{homeworld}', [PeopleController::class, 'index']);
Route::get('/peoples/seed', [PeopleController::class, 'seed']);

Route::resources([
    'peoples' => PeopleController::class,
    'films' => MovieController::class,
]);
