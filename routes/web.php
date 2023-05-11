<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'edit')->name('profile.edit');
            Route::patch('/', 'update')->name('profile.update');
            Route::delete('/', 'destroy')->name('profile.destroy');
        });
    });

    Route::controller(TaskListController::class)->group(function () {
        Route::group(['prefix' => 'task-lists'], function() {
            Route::get('/', 'index')->name('dashboard');
            Route::post('/', 'create')->name('task_list.create');
            Route::get('/{list}', 'detail')->name('task_list.detail');
            Route::delete('/{list}', 'delete')->name('task_list.delete');
        });
    });

    Route::controller(TaskController::class)->group(function () {
        Route::post('/task-lists/{taskList}/tasks', 'create')
            ->name('task.create');
        Route::post('/tasks/{task}/complete', 'complete')
            ->name('task.complete');
    });
});

require __DIR__.'/auth.php';
