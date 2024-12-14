<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;
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

//Route::get('/members/index', [MemberController::class, '/members/index']);
Route::get('/members/create', [MemberController::class, '/members/create']);
Route::get('/events/index', [EventController::class, '/events/index']);
Route::get('/events/create', [EventController::class, '/events/create']);
Route::get('/successStories/index', [SuccessStoryController::class, '/successStories/index']);
Route::get('/successStories/create', [SuccessStoryController::class, '/successStories/create']);
