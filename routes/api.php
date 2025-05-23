<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/books', [BookController::class,'index']);
Route::post('/books', [BookController::class,'store']);
Route::get('/books/{id}', [BookController::class,'show']);
Route::post('/books/{id}',[BookController::class,'update']);
Route::delete('/books/{id}',[BookController::class,'destroy']);


Route::get('/genres',[GenreController::class,'index']);
Route::post('/genres',[GenreController::class,'store']);
Route::get('/genres/{id}', [GenreController::class,'show']);
Route::post('/genres/{id}',[GenreController::class,'update']);
Route::delete('/genres/{id}',[GenreController::class,'destroy']);


Route::get('/authors',[AuthorController::class,'index']);
Route::post('/authors',[AuthorController::class,'store']);
Route::get('/authors/{id}',[AuthorController::class,'show']);
Route::post('/authors/{id}',[AuthorController::class,'update']);
Route::delete('authors/{id}',[AuthorController::class,'destroy']);
