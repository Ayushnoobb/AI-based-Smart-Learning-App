<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;

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

Route::group(['prefix' => 'user-role'], function () {
    Route::get('/all-roles',[RoleController::class , 'index']);
    Route::post('/create',[RoleController::class , 'createRole'] );
    Route::post('/update/{role}',[RoleController::class ,'updateRole'] );
    Route::delete('/delete/{role}' , [RoleController::class , 'deleteRole']);
});


// Route::middleware(['auth:api', 'role:student'])->group(function () {
//     Route::get('/student-dashboard', [StudentController::class, 'index']);
// });

// Route::middleware(['auth:api', 'role:teacher'])->group(function () {
//     Route::get('/teacher-dashboard', [TeacherController::class, 'index']);
// });


