<?php

use App\Http\Controllers\CategoryController;
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
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::get('/showbyid/{id}', [CategoryController::class, 'show']);
        Route::delete('/delete/{id}', [CategoryController::class,'destroy']); 
    });
