<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::get('/dashboard', function () {
    return view('dashboard'); // looks for resources/views/dashboard.blade.php
})->name('dashboard');