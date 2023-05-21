<?php

use App\Http\Controllers\AllowedUserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::post('/singup', [UserController::class, 'register']);
Route::post('/singin', [UserController::class, 'singIn']);

Route::middleware(['auth:sanctum', 'abilities:admin'])->get('/user/getme', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->get('/verifi_email/{id}/{hash}', [UserController::class, 'verifiemail'])->name('verification.verify');;

Route::middleware('auth:sanctum')->post('/sendcode', [UserController::class, 'sendcode']);
Route::middleware('auth:sanctum')->post('/verificode', [UserController::class, 'verificode']);

Route::prefix('/category')
    ->group(function () {
        Route::get('/showall', [CategoryController::class, 'index']);
        Route::get('/showbyid/{id}', [CategoryController::class, 'show']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/category')
    ->group(function () {
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    });

Route::prefix('/collection')
    ->group(function () {
        Route::get('/showall', [CollectionController::class, 'index']);
        Route::get('/show/{id}', [CollectionController::class, 'show']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/collection')
    ->group(function () {
        Route::post('/add', [CollectionController::class, 'store']);
        Route::patch('/update/{id}', [CollectionController::class, 'update']);
        Route::delete('/delete/{id}', [CollectionController::class, 'destroy']);
    });

Route::prefix('/question')
    ->group(function () {
        Route::get('/showall', [QuestionController::class, 'index']);
        Route::get('/show/{id}', [QuestionController::class, 'show']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/question')
    ->group(function () {
        Route::post('/add', [QuestionController::class, 'store']);
        Route::delete('/delete/{id}', [QuestionController::class, 'destroy']);
        Route::patch('/update/{id}', [QuestionController::class, 'update']);
    });


Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/allowed')
    ->group(function () {
        Route::post('/add', [AllowedUserController::class, 'store']);
        Route::delete('/delete/{id}', [AllowedUserController::class, 'destroy']);
    });


Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/answer')
    ->group(function () {
        Route::post('/add', [AnswerController::class, 'store']);
        Route::delete('/delete/{id}', [AnswerController::class, 'destroy']);
        Route::put('/update/{id}', [AnswerController::class, 'update']);
    });

Route::prefix('/result')
    ->group(function () {
        Route::get('/calc', [ResultController::class, 'calculate']);
        Route::get('/calcquestion', [ResultController::class, 'calculateQuestion']);
        Route::get('/calccollection', [ResultController::class, 'calculateCollection']);
        Route::get('/all', [ResultController::class, 'index']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/result')
    ->group(function () {
        Route::post('/add', [ResultController::class, 'store']);
    });
