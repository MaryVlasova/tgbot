<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BotSettingsController;
use App\Http\Controllers\Backend\CategoryNotesController;
use App\Http\Controllers\Backend\NoteController;
use App\Http\Controllers\HomeController;


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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
    ->name('index');


    Route::resource('/category-notes', CategoryNotesController::class)
    ->parameters(['category-notes' => 'categoryNotes'])     
    ->name('*', 'category');

    Route::resource('/settings', BotSettingsController::class)
    ->only(['index', 'edit', 'update'])
    ->parameters(['settings' => 'botSettings'])
    ->name('*', 'settings');




    
    Route::resource('/notes', NoteController::class)
    ->name('*', 'notes');
    // Route::get('notes/create', 'NotesController@create');
    // Route::get('notes/store', 'NotesController@store');
    // Route::get('notes/{id}/edit', 'NotesController@edit');
    // Route::get('notes/{id}/update', 'NotesController@update');
    // Route::get('notes/{id}/show', 'NotesController@show');
    // Route::get('notes/{id}/destroy', 'NotesController@destroy');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
