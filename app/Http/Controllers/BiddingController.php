<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use App\Pusher\Pusher;
use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function bid(Request $request)
    {

        if($request->has('bid')){
            $user           = User::findorFail($request->user);             // Authenticated User
            $auction        = Auction::findOrFail($request->auction);       // Auction
            $bid            = $request->bid;                                // Submitted Bid
            event(new \App\Events\BidEvent($user->name, $bid,$auction->id));
            /*$pusher         = new Pusher($bid,$user->name,$auction);        // Pusher Class
            $data = [
                'problems'      => $pusher->response['problems'],
                'status'        => $pusher->response['status'],
            ];

            return response()->json($data);*/
            return [
                'status' => true
            ];
        }

        return [
            'status' => false
        ];
    }
}
