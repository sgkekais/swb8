<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified', 'is_banned'])->group(function () {
    // Dashboard for all logged-in users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin functionality
    Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
        // log
        Route::view('log', 'admin.log')->name('log');

        // teams
        Route::view('clubs', 'admin.clubs.index')->name('clubs');
        // locations
        Route::view('locations', 'admin.locations.index')->name('locations');
    });

});
