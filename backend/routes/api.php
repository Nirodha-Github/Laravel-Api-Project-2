<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//customers
Route::get('customers',[CustomerController::class, 'index']);
Route::post('customer/new',[CustomerController::class, 'store']);
Route::get('customer/{customerid}',[CustomerController::class, 'show']);
Route::post('customer/{customerid}/update',[CustomerController::class, 'update']);

//project
Route::get('projects',[ProjectController::class, 'index']);
Route::post('project/new',[ProjectController::class, 'store']);
Route::get('project/{projectid}',[ProjectController::class, 'show']);
Route::post('project/{projectid}/update',[ProjectController::class, 'update']);
Route::delete('project/{projectid}/delete',[ProjectController::class, 'destroy']);