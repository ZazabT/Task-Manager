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
        
        // Get specific project details
        Route::get('/projects/{project}', 'get')->name('project.get');

        // Add or store a new task
        Route::post('/projects/addtask', 'store')->name('project.store');

        // Display update view for a specific project
        Route::get('/projects/update/{project}', 'edit')->name('project.edit');

        // Update a specific project
        Route::post('/projects/update/{project}', 'update')->name('project.update');

        // Delete a specific project
        Route::post('/projects/delete/{project}', 'destroy')->name('project.delete');
    });
});

