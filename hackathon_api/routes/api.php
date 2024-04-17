<?php

use App\Http\Controllers\admin\AdminAuthUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\categorie\CategorieController;

use App\Http\Controllers\student\StudentProfileController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->middleware('auth:api');

    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller(AdminAuthUsers::class)->group(function () {
    Route::resource('categorie', CategorieController::class);

    Route::post('AdminAuth', 'register');
});
Route::controller(StudentProfileController::class)->group(function () {

    Route::put('UpdateProfil', 'UpdateProfil');
    Route::put('UpdatePassword', 'UpdatePassword');
});