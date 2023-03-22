<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Auction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $auctions = \App\Models\Auction::all();
    return view('welcome',compact('auctions'));
});

Route::get('/dashboard', function () {
    $auctions = \App\Models\Auction::all();
    return view('dashboard',compact('auctions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/auction/{auction}', function (Auction $auction) {
        return view('auction',compact('auction'));
    })->middleware(['auth'])->name('auction.view');

    Route::post('/bid-process/', [\App\Http\Controllers\BiddingController::class, 'bid'])->name('bid.process');
});

require __DIR__.'/auth.php';
