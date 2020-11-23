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
    return view('index');
})->name('home');

Route::middleware(['auth:sanctum', 'verified', 'is_banned'])->group(function () {
    // Dashboard for all logged-in users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin functionality
    Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
        // Log
        Route::view('log', 'admin.log')->name('log');

        // Teams
        Route::view('clubs', 'admin.clubs.index')->name('clubs');
        // Locations
        Route::view('locations', 'admin.locations.index')->name('locations');

        // Date Types
        Route::view('date-types', 'admin.date_types.index')->name('date-types');
        // Dates
        Route::view('dates', 'admin.dates.index')->name('dates');
        // Match types
        Route::view('match-types', 'admin.match_types.index')->name('match-types');
        // Matches
        Route::view('matches', 'admin.matches.index')->name('matches');
    });

});
