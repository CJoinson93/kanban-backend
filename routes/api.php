<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('todo-lists', [TodolistsController::class, 'all']);
Route::post('todo-lists', [TodoListsController::class, 'store']);
Route::patch('todo-lists/{todoList}', [TodoListsController::class, 'update']);

Route::get('cards/{card}', [CardsController::class, 'gets']);
Route::post('cards', [CardsController::class, 'store']);
Route::patch('cards/{card}', [CardsController::class, 'update']);