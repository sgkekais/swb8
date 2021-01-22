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

Route::get('/kalender', Calendar::class)->name('calendar');

Route::get('/umfrage/{date}', Poll::class)->name('poll');

/*
 * --------------------------------------------------------------------------
 * Frontpage Club Routes
 * --------------------------------------------------------------------------
 */

// fixtures -> how?
Route::prefix('team')->name('club.')->group(function () {
    Route::get('/{club}/spielplan',Schedule::class )->name('schedule');
});
// goals & assists
Route::prefix('team')->name('club.')->group(function () {
    Route::get('/{club}/scorers',Scorers::class )->name('scorers');
});
// cards

/*
 * --------------------------------------------------------------------------
 * Routes for Members
 * --------------------------------------------------------------------------
 */
Route::middleware(['auth:sanctum', 'verified', 'is_banned'])->group(function () {
    // Dashboard for all logged-in users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
     * --------------------------------------------------------------------------
     * Admin Routes
     * --------------------------------------------------------------------------
     */
    Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function () {
        // Log
        Route::view('log', 'admin.log')->name('log');

        // Date Types
        Route::view('date-types', 'admin.date_types.index')->name('date-types');
        // Dates
        Route::view('dates', 'admin.dates.index')->name('dates');
        // Match Types
        Route::view('match-types', 'admin.match_types.index')->name('match-types');
        // Matches
        Route::view('matches', 'admin.matches.index')->name('matches');
        // Tournaments
        Route::view('tournaments', 'admin.tournaments.index')->name('tournaments');
        // Seasons
        Route::view('seasons', 'admin.seasons.index')->name('seasons');
        // Teams
        Route::view('clubs', 'admin.clubs.index')->name('clubs');
        // Player Status
        Route::view('player-statuses', 'admin.player_statuses.index')->name('player-statuses');
        // Players
        Route::view('players', 'admin.players.index')->name('players');
        // Cards
        Route::view('cards', 'admin.cards.index')->name('cards');
        // Goals
        Route::view('goals', 'admin.goals.index')->name('goals');
        // Assists
        Route::view('assists', 'admin.assists.index')->name('assists');
        // Locations
        Route::view('locations', 'admin.locations.index')->name('locations');
    });
});
