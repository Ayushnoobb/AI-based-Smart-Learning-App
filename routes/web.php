<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;

require base_path('routes/myRoutes.php');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/api/dataget',[DataController::class , 'fetchData'] );

// Route::middleware(['auth:api', 'role:admin'])->group(function () {
//     Route::get('/admin-dashboard', [AdminController::class, 'index']);
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login',[LoginController::class ,'login'] );
    Route::post('/register',[LoginController::class ,'register'] );
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index']);
});


Route::middleware(['auth:api', 'role:student'])->group(function () {
    Route::get('/student-dashboard', [StudentController::class, 'index']);
});

Route::middleware(['auth:api', 'role:teacher'])->group(function () {
    Route::get('/teacher-dashboard', [TeacherController::class, 'index']);
});


