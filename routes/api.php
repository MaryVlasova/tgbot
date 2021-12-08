<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryNotesController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::name('api.')->middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResource('/categories', CategoryNotesController::class)
    ->parameters(['categories' => 'categoryNotes'])
    ->name('*', 'categories');


    Route::apiResource('/notes', NoteController::class) 
    ->name('*', 'notes');

    Route::apiResource('/roles', CategoryNotesController::class);    

    Route::apiResource('/permissions', CategoryNotesController::class)->only(['index', 'show']);

});

