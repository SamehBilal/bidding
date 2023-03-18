<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function bid(Request $request)
    {
        return event(new \App\Events\BidEvent($request->input('name'),$request->input('bid'),1));

        /*$auction = Auction::findOrFail($request->auction_id);
        if($request->amount > $auction->starting_bid && $request->amount >= $auction->highest_bid)
        {
            return $auction->highest_bid;
        }*/
        return true;
    }
}
