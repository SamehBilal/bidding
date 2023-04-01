<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('chat/auction/{auction}', function (Auction $auction) {
    return view('chat',compact('auction'));
})->middleware(['auth'])->name('auction.view');

Route::post('/message/{auction}', [\App\Http\Controllers\MessagesController::class, 'store'])->name('message.store');
