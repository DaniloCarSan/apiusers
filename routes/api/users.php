<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->post('users',[App\Http\Controllers\Api\User\CreateController::class,'execute']);
Route::middleware('auth:sanctum')->get('users',[App\Http\Controllers\Api\User\ListController::class,'execute']);
Route::middleware('auth:sanctum')->get('users/{id}',[App\Http\Controllers\Api\User\SelectController::class,'execute'])->where('id','[0-9]+');
Route::middleware('auth:sanctum')->put('users/{id}',[App\Http\Controllers\Api\User\UpdateController::class,'execute'])->where('id','[0-9]+');
Route::middleware('auth:sanctum')->delete('users/{id}',[App\Http\Controllers\Api\User\DeleteController::class,'execute'])->where('id','[0-9]+');

