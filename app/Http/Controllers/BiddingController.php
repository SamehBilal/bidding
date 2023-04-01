<?php

namespace App\Http\Controllers;

use App\Jobs\PublishCar;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use App\Helper\Pusher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function bid(Request $request)
    {

        if($request->has('bid')){
            $user           = User::findorFail($request->user);             // Authenticated User.
            $auction        = Auction::findOrFail($request->auction);       // Auction.
            $bid            = $request->bid;                                // Submitted Bid Amount.

            $pusher         = new Pusher($auction,$bid,$user);              // Returning Pusher Helper Class.

            return $pusher->response;
        }

        return [
            'status' => false
        ];
    }

    public function scheduled_publish(Request $request,Bid $bid)
    {
        if ($request->publish_date)
        {
            $Publish_date = Carbon::parse($request->publish_date);
            PublishCar::dispatch($bid)
                ->delay($Publish_date);
        }
    }
}
