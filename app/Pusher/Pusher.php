<?php

namespace App\Pusher;

use App\Models\Auction;
use App\Models\Bid;

class Pusher
{
    public $bid;
    public $auction;
    public $response;

    public function __construct($bid, $user, $auction)
    {
        $this->response = [
            'problems' => [],
            'status'   => '',
            'content'  => '',
        ];
        $this->bid = $bid;
        $this->auction = $auction;
        $validation = $this->validateBid($this->bid, $this->auction); // Validate bid
        if($validation)
        {
            $type = $this->{$auction->type}($this->auction,$this->bid);
            if(!$type){
                if($auction->type == 'pbased')
                {
                    $this->createBid($this->bid,$this->auction,$user->id);
                    $this->broadcast($user->name,$this->bid, $this->auction); // broadcasting the bid
                }
                $this->response['status'] = 'closed';
                return $this->response;
            }
            $this->createBid($this->bid,$this->auction,$user->id);
            $this->broadcast($user->name,$this->bid, $this->auction); // broadcasting the bid
            $this->UpdateBid($this->auction,$this->bid); // Updating the highest bid
        }

        return $this->response;
    }


    private function validateBid($bid, $auction)
    {
        $lowestbid = $this->LowestBid($auction);

        if ($bid < $lowestbid) {
             array_push($this->response['problems'], 'Your bid is lower than the allowed amount');

            return false;
        }

        return true;
    }

    private function createBid($bid_amount,$auction_id,$user_id)
    {
        $bid = Bid::create([
            'bid_amount'        => $bid_amount,
            'auction_id'        => $auction_id,
            'user_id'           => $user_id,
        ]);

        return $bid;
    }

    private function tbased($auction,$bid=null)
    {
        if ((now() >= $auction->starting_time) && (now() <= $auction->ending_time)){
            if($this->dynamicTime($auction))
            {
                $this->UpdateBid($this->auction,$this->bid,'dynamicTime'); // Updating ending time
            }
            return true;
        }
        $this->UpdateBid($this->auction,$this->bid,'tbased'); // Updating the status
        return false;
    }

    private function dynamicTime($auction,$bid=null)
    {
        $start_time = $auction->ending_time->subMinutes(5);
        if ((now() >= $start_time) && (now() <= $auction->ending_time)){
            return true;
        }

        return false;
    }

    private function pbased($auction,$bid)
    {
        if($bid->bid_amount < $auction->desired_price)
        {
            return true;
        }
        $this->UpdateBid($this->auction,$this->bid,'pbased'); // Updating the highest bid & Status
        return false;
    }

    private function altomo()
    {
        //
    }

    private function UpdateBid(Auction $auction,$bid,$status=null)
    {
        if($status == 'pbased')
        {
            $auction->update([
                'highest_bid'       => $bid,
                'status'            => 0,
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
                'status'            => 0,
            ]);
        }else{
            $auction->update([
                'highest_bid'       => $bid,
            ]);
        }
    }

    private function broadcast($name, $bid, $auction)
    {
        event(new \App\Events\BidEvent($name, $bid,$auction));
    }

    private function LowestBid($auction)
    {
        return ($auction->highest_bid * $auction->bid_ratio)/100;
    }
}
