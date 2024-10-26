<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/app")->group(function () {
  Route::get("/get" ,function (){
    return view('hello');
  } );
});

Route::prefix('/courses')->group(function (){
  Route::get('',function (){ 

  });
});

Route::prefix('/users')->group(function (){
  Route::get('',function (){

  });
});

