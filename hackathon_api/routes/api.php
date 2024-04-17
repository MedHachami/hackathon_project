<?php

use App\Http\Controllers\admin\AdminAuthUsers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\student\StudentProfileController;
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


Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->middleware('auth:api');


    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post("admin_login", "adminlogin");
});

Route::controller(AdminAuthUsers::class)->group(function () {

    Route::post('AdminAuth', 'register');
});
Route::controller(StudentProfileController::class)->group(function () {

    Route::put('UpdateProfil', 'UpdateProfil');
    Route::put('UpdatePassword', 'UpdatePassword');
});
Route::apiResource("projects", ProjectController::class);
Route::post("filter", [ProjectController::class, "filter"]);
