<?php

use App\Http\Controllers\Api\Auth\SignInController;
use Illuminate\Support\Facades\Route;

Route::post('auth/sign/in',[SignInController::class,'execute']);
