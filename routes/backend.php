<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    // Route::get('/', 'create')->name('create');
    // Route::get('/', 'edit')->name('edit');
    // Route::post('/', 'store')->name('store');
    // Route::post('/', 'update')->name('update');

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

});

Route::controller(UserController::class)->group(function(){
    Route::get('/users/allusers', 'users_allusers')->name('backend.users.allusers');
});
