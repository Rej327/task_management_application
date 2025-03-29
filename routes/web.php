<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Redirect "/" to the task index page
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Resourceful routes for tasks (CRUD), excluding the index method
Route::resource('tasks', TaskController::class)->except(['index']);

// Route to toggle task status (completed or pending)
Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');
