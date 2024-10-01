<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    // Login
    Route::get('login', 'showLogin')->name('auth.login.view');         // Login view
    Route::post('login', 'login')->name('auth.login.func');            // Login function route
    
    // Register
    Route::get('register', 'showRegister')->name('auth.register.view'); // Register view
    Route::post('register', 'register')->name('auth.register.func');    // Register function route

    // Logout
    Route::get('logout', 'logout')->name('auth.logout');                // Logout Function
});



// Authenticated user routes
Route::middleware('auth')->group(function () {


    // Project routes
    Route::controller(ProjectController::class)->group(function () {
        // Show home page or project page
        Route::get('/', 'show')->name('project.show');
        
        // get specific project
        Route::get('/{id}' , 'get')->name('project.get');

        // add or store project
        Route::post('/addtask' , 'store')->name('project.store');

        // display update view
        Route::get('/update/{id}' , 'edit')->name('project.edit');

        // update project
        Route::post('/update/{id}' , 'update')->name('project.update');

        // delete project
        Route::get('/delete/{id}' , 'destroy')->name('project.delete');
    });
});
