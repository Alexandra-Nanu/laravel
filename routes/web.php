<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SuccessStoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/members/index', [MemberController::class, 'index']);
/*Route::get('/members/create', [MemberController::class, 'create']);*/

Route::get('/events/index', [EventController::class, 'index']);
/*Route::get('/events/create', [EventController::class, 'create']);*/

Route::get('/successStories/index', [SuccessStoryController::class, 'index']);
/*Route::get('/successStories/create', [SuccessStoryController::class, 'create']);*/

Route::prefix('members')->group(function () {
    /* Route::get('/', [MemberController::class, 'index'])->name('members.index'); // Listare membri*/
    Route::get('/create', [MemberController::class, 'create'])->name('members.create'); // Formular creare membru
    Route::post('/', [MemberController::class, 'store'])->name('members.store'); // Salvare membru nou
    Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('members.edit'); // Formular editare
    Route::patch('/{id}', [MemberController::class, 'update'])->name('members.update'); // Actualizare membru
    Route::delete('/{id}', [MemberController::class, 'destroy'])->name('members.destroy'); // Ștergere membru
});


Route::prefix('events')->group(function () {
    /*Route::get('/', [EventController::class, 'index'])->name('events.index');*/
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/', [EventController::class, 'store'])->name('events.store');
    Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::patch('/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::prefix('successStories')->group(function () {
    /*Route::get('/', [SuccessStoryController::class, 'index'])->name('successStories.index');*/
    Route::get('/create', [SuccessStoryController::class, 'create'])->name('successStories.create');
    Route::post('/', [SuccessStoryController::class, 'store'])->name('successStories.store');
    Route::get('/{id}/edit', [SuccessStoryController::class, 'edit'])->name('successStories.edit');
    Route::patch('/{id}', [SuccessStoryController::class, 'update'])->name('successStories.update');
    Route::delete('/{id}', [SuccessStoryController::class, 'destroy'])->name('successStories.destroy');
});
