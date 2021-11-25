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

Route::get('/test', function(Request $request) {
    return response()->json(['work' => true]);
});

//register new user
//Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
// Route::get('/test', function () {
//     return response()->json([
//         'name' => 'Abigail',
//         'state' => 'CA',
//     ]);
// });
//login user
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
//using middleware

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::name('api.')->middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/categories', CategoryNotesController::class)
    ->except(['create', 'eidt'])
    ->parameters(['categories' => 'id'])     
    ->name('*', 'category');

    // Route::get('categories', [CategoryNotesController::class, 'index'])->name('categories.index');
    // Route::get('categories/{categoryNotes}', [CategoryNotesController::class, 'show'])->name('categories.show');
    // Route::post('categories', [CategoryNotesController::class, 'store'])->name('categories.store');
    // Route::put('categories/{categoryNotes}', [CategoryNotesController::class, 'update'])->name('categories.update');
    // Route::delete('categories/{categoryNotes}', [CategoryNotesController::class, 'delete'])->name('categories.delete');

    Route::resource('/notes', NoteController::class)
    ->except(['create', 'eidt'])
    ->parameters(['notes' => 'id'])     
    ->name('*', 'notes');


    // Route::get('notes', [NoteController::class, 'index'])->name('notes.index');
    // Route::get('notes/{note}', [NoteController::class, 'show'])->name('notes.show');
    // Route::post('notes', [CategoryNotesController::class, 'store'])->name('notes.store');
    // Route::put('notes/{note}', [CategoryNotesController::class, 'update'])->name('notes.update');
    // Route::delete('notes/{note}', [CategoryNotesController::class, 'delete'])->name('notes.delete');
});




// добавить сообщение
//Route::post('categories', [CategoryNotesController::class, 'create']);
// обновить сообщение
//Route::put('categories/{id}', [CategoryNotesController::class, 'update']);
// удалить сообщение
//Route::delete('categories/{id}', [CategoryNotesController::class, 'delete']);
// добавить нового пользователя с ролью Writer
//Route::post('users/writer', [CategoryNotesController::class, 'createWriter']);
// добавить нового пользователя с Subscriber 
// Route::post(
//     'users/subscriber',
//     [ControllerExample::class, 'createSubscriber']
// );
// удалить пользователя
//Route::delete('users/{id}', [ControllerExample::class, 'deleteUser']);



// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function(Request $request) {
//         return auth()->user();
//     });
//     Route::post('/sign-out', [AuthenticationController::class, 'logout']);
// });