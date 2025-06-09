<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\ContentController;
Route::middleware(['auth'])->group(function () {
    Route::resource('contents', ContentController::class);
    Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
});

Route::get('/player', [ContentController::class, 'player'])->name('player');

use App\Http\Controllers\PlaylistController;
Route::resource('playlists', PlaylistController::class)->middleware('auth');

use App\Http\Controllers\PlayerController;
Route::get('/player/{identifier}', [PlayerController::class, 'showPlayer'])->name('player.show');
Route::middleware(['auth'])->group(function () {
    Route::resource('players', PlayerController::class);
Route::get('/preview/playlist/{id}', [PlayerController::class, 'preview'])->name('playlist.preview');
    Route::resource('players', PlayerController::class);
    
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');


Route::post('/playlists/{playlist}/order', [App\Http\Controllers\PlaylistController::class, 'updateOrder'])->name('playlists.order');

Route::post('/playlists/{playlist}/contents/{content}/add-ajax', [App\Http\Controllers\PlaylistController::class, 'addContentAjax'])->name('playlists.contents.add-ajax');
Route::post('/playlists/{playlist}/contents/{content}/remove-ajax', [App\Http\Controllers\PlaylistController::class, 'removeContentAjax'])->name('playlists.contents.remove-ajax');