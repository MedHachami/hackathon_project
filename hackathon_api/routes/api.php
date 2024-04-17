<?php

use App\Http\Controllers\admin\AdminAuthUsers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\categorie\CategorieController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\student\StudentProfileController;
use App\Http\Controllers\teacher\TeacherRatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->middleware('auth:api');

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post("admin_login", "adminlogin");
});

Route::resource('categories', CategorieController::class);

Route::resource('categorie', CategorieController::class);
Route::middleware(['check.role:admin'])->group(function () {
    // Route::resource('categories', CategorieController::class);

    Route::controller(AdminAuthUsers::class)->group(function () {

        Route::post('AdminAuth', 'register');
    });
});
//Route::middleware(['check.role:teacher'])->group(function () {
    Route::controller(TeacherRatingController::class)->group(function () {

        Route::post('CreateRating', 'CreateRating');
        Route::get('EditRating/{id}', 'EditRating');
        Route::put('UpdateRating/{id}', 'UpdateRating');
        Route::delete('DeleteRating/{id}', 'DeleteRating');

    });
//});

Route::middleware(['check.role:student'])->group(function () {
    Route::controller(StudentProfileController::class)->group(function () {

        Route::put('UpdateProfil', 'UpdateProfil');
        Route::put('UpdatePassword', 'UpdatePassword');
    });

    Route::apiResource("projects", ProjectController::class);
});
Route::post("filter", [ProjectController::class, "filter"]);
Route::post("projects/{id}/restore", [ProjectController::class, "restore"]);

Route::get("ranking", [RankingController::class, "handle"]);

