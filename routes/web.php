<?php

use App\Http\Controller\TaskController;
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

Route::prefix('task')->group(function() {
    Route::get('/show_tasks', [TaskController::class, 'showTasks']);
    Route::post('/create_task', [TaskController::class, 'createTask']);
    Route::put('/update_task', [TaskController::class, 'updateTask']);

    // NOTE: lanjutkan tugas assignment di routing baru dibawah ini
    Route::delete('/delete_task', [TaskController::class, 'deleteTask']); //sudah ada
    Route::patch('/assign_task', [TaskController::class, 'assignTask']); //sudah ada
    Route::patch('/unassign_task', [TaskController::class, 'unassignTask']); //sudah ada
    Route::patch('/create_subtask', [TaskController::class, 'createSubtask']); //sudah ada
    Route::patch('/delete_subtask', [TaskController::class, 'deleteSubtask']); //sudah ada
});