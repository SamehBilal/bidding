<?php

namespace App\Helper;

use App\Models\Auction;
use App\Models\Bid;

class Pusher
{
    public $response;

    public function __construct($auction, $bid, $user)
    {
        /* Response array */
        $this->response = [
            'problems' => [], // Problems to be returned to user.
            'action'   => [], // action to be done.
            'status'   => false,
        ];

        if(!$auction->status)
        {
            $this->response['problems'] = 'Auction is Closed'; // Pushing the problem to the end user.
            return $this->response;
        }

        $validation = $this->validateBid($auction, $bid); // Validating bid.
        if($validation)
        {
            $type = $this->{$auction->type}($auction,$bid); // Declaring the type of auction function.
            if(!$type){
                if($auction->type == 'pbased')
                {
                    $bid = $this->createBid($auction->id,$bid,$user->id);       // Creating Bid.
                    $this->broadcast($auction,$bid, $user->name);               // broadcasting the bid.
                }
                $this->response['problems'] = 'Auction is Closed'; // Pushing the problem to the end user.
                return $this->response;
            }
            $bidModel = $this->createBid($auction->id,$bid,$user->id);         // Creating Bid.
            $this->broadcast($auction,$bidModel, $user->name);                 // broadcasting the bid.
            $this->UpdateAuction($auction,$bid);                               // Updating the highest bid.
            $this->response['status'] = true;
        }

        return $this->response;
    }

    /* Validating bid amount */
    private function validateBid($auction, $bid)
    {
        $lowestbid = $this->LowestBid($auction); // Get the lowest allowed bid amount

        if ($bid < $lowestbid || $bid < ($auction->highest_bid)+$lowestbid) {
             array_push($this->response['problems'], 'Your bid is lower than the allowed amount'); // Pushing the problem to the end user.

            return false;
        }

        return true;
    }

    /* Saving the bid into database */
    private function createBid($auction_id,$bid_amount,$user_id)
    {
        $bid = Bid::create([
            'bid_amount'        => $bid_amount,
            'auction_id'        => $auction_id,
            'user_id'           => $user_id,
        ]);

        return $bid;
    }

    /* Validating the bid in the time-based type auction */
    private function tbased($auction,$bid=null)
    {
        if ((now() >= $auction->starting_time) && (now() <= $auction->ending_time)){
            if($this->dynamicTime($auction))
            {
                array_push($this->response['action'], 'Update the counter.'); // Pushing the action to the response.
                $this->UpdateAuction($auction,$bid,'dynamicTime'); // Updating ending time
            }
            return true;
        }

        $this->UpdateAuction($auction,$bid,'tbased'); // Updating the status

        return false;
    }

    /* Determine if the bid occurred in the last 5 minutes */
    private function dynamicTime($auction)
    {
        $start_time = $auction->ending_time->subMinutes(5);
        if ((now() >= $start_time) && (now() <= $auction->ending_time)){
            return true;
        }

        return false;
    }

    /* Validating the bid in the price-based type auction */
    private function pbased($auction,$bid)
    {
        if($bid < $auction->desired_price)
        {
            return true;
        }
        $this->UpdateAuction($auction,$bid,'pbased'); // Updating the highest bid & Status

        return false;
    }

    private function altomo()
    {
        return true;
    }

    /* Updating the auction's fields */
    private function UpdateAuction(Auction $auction,$bid,$status=null)
    {
        if($status == 'pbased')
        {
            $auction->update([
                'highest_bid'       => $bid,
                'status'            => false,
            ]);
        }
        elseif ($status == 'dynamicTime'){
            $time = $auction->ending_time->addMinutes(5);
            $auction->update([
                'ending_time'       => $time,
            ]);
        }
        elseif ($status == 'tbased'){
            $auction->update([
                'status'            => false,
            ]);
        }else{
            $auction->update([
                'highest_bid'       => $bid,
            ]);
        }
    }

    /* Broadcasting bid to all the subscribers to the auction channel */
    private function broadcast($auction, $bid, $name)
    {
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true,
        );

        $pusher = new \Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'bid' => $bid->bid_amount,
            'name' => $name,
            'created_at' => $bid->created_at->diffForHumans(),
            'status' => true,
        ];

        $pusher->trigger('auction.'.$auction->id, 'App\\Events\\BidEvent', $data);
    }

    /* Determine the lowest allowed bid amount */
    private function LowestBid($auction)
    {
        return ($auction->starting_bid * $auction->bid_ratio)/100;
    }
}
