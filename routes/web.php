<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/board/{id}', [\App\Http\Controllers\BoardController::class, 'index'])
    ->name('boards.index');

Route::post('/task', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');

Route::get('/test', function () {
    return Inertia::render('test');
});

Route::get('/add_user_in_board/{userId}/{boardId}', [\App\Http\Controllers\BoardController::class, 'addOrChangeAccessLevel']);


Route::get('/create/board/{count}', [\App\Http\Controllers\devControllers\GenerateController::class, 'generateBoards']);
//Route::get('/create/task/{count}', [\App\Http\Controllers\devControllers\GenerateController::class, 'generateTasks']);
//Route::get('create/user/{count}', [\App\Http\Controllers\devControllers\GenerateController::class, 'generateUsers']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
