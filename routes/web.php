<?php

use App\Http\Controllers\ProfileController;
use App\Jobs\PublishCar;
use Carbon\Carbon;
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
    $publish_date = '2023-03-26 04:28:20';
    $Publish_date = Carbon::parse($publish_date);
    $bid = \App\Models\bid::findOrFail(4);
    PublishCar::dispatch($bid)
        ->delay($Publish_date);
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

    Route::get('/auction/{auction}', function (Auction $auction) {
        return view('auction',compact('auction'));
    })->middleware(['auth'])->name('auction.view');

    Route::get('chat/auction/{auction}', function (Auction $auction) {
        return view('chat',compact('auction'));
    })->middleware(['auth'])->name('auction.view');

    Route::post('/message/{auction}', [\App\Http\Controllers\MessagesController::class, 'store'])->name('message.store');

    Route::post('/bid-process/', [\App\Http\Controllers\BiddingController::class, 'bid'])->name('bid.process');
});

require __DIR__.'/auth.php';
