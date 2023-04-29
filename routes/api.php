<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/singup',[UserController::class,'register']);
Route::post('/singin',[UserController::class,'singIn']);

Route::middleware(['auth:sanctum', 'abilities:admin'])->get('/user/getme',[UserController::class,'show']);

Route::prefix('/category')
    ->group(function () {
        Route::get('/showall', [CategoryController::class, 'index']);
        Route::get('/showbyid/{id}', [CategoryController::class, 'show']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/category')
    ->group(function () {
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class,'destroy']); 
    });

Route::prefix('/collection')
    ->group(function(){
        Route::get('/showall',[CollectionController::class,'index']);
        Route::get('/show/{id}',[CollectionController::class,'show']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/collection')
    ->group(function(){
        Route::post('/add',[CollectionController::class,'store']);
        Route::patch('/update/{id}',[CollectionController::class,'update']);
        Route::delete('/delete/{id}',[CollectionController::class,'destroy']);
    });