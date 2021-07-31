<?php

use App\Http\Controllers\todoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [todoController::class, 'index']);
 Route::post('/addTodo', [todoController::class, 'addTodo']);
 Route::get('/deleteTodo/{id}', [todoController::class, 'deleteTodo']);
 Route::get('/changeStatusTodo/{id}', [todoController::class, 'changeStatusTodo']);
 