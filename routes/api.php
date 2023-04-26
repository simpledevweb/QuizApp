<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/singup',[UserController::class,'register']);
Route::post('/singin',[UserController::class,'singIn']);

Route::get('/user/getme',[UserController::class,'show'])->middleware(['auth:sanctum', 'abilities:admin']);


Route::prefix('/category')
    ->group(function () {
        Route::get('/showall', [CategoryController::class, 'index']);
        Route::get('/showbyid/{id}', [CategoryController::class, 'show']);
    });

Route::prefix('/category')
    ->group(function () {
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class,'destroy']); 
    })->middleware(['auth:sanctum', 'abilities:admin']);


Route::prefix('/collection')
    ->group(function(){
        Route::get('/showall',[CollectionController::class,'index']);
        Route::get('/show/{id}',[CollectionController::class,'show']);
    });

Route::prefix('/collection')
    ->group(function(){
        Route::post('/add',[CollectionController::class,'store']);
        Route::patch('/update/{id}',[CollectionController::class,'update']);
        Route::delete('/delete/{id}',[CollectionController::class,'destroy']);
    })->middleware(['auth:sanctum', 'abilities:admin']);