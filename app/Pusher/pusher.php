<?php

namespace App\Pusher;

use App\Models\Auction;

class pusher
{
    private $bid;
    private $auction;
    public  $response;

    public function __construct($bid, $auction)
    {
        $this->response = [
            'problems'      => [],
            'improvements'  => [],
            'good_results'  => [],
            'final_score'   => 0,
            'total_score'   => $score,
            'content'       => '',
        ];
        $this->bid = $bid;
        $this->auction = Auction::findOrFail($auction);
        $this->validateBid($this->bid,$this->auction);

        return $this->response;
    }

    private function validateBid($bid,$auction)
    {
        if($bid)
        {
            $bid > $auction->starting_bid && $bid >= $auction->highest_bid ? '':'';
        }

        array_push($this->response['errors'], $this->errors['content']['length']);

        return 'Add bid first!';
    }

    private function tBased()
    {

    }

    private function dynamicTime()
    {

    }

    private function altomo()
    {

    }

    private function pBased()
    {

    }

    private function UpdateBid($bid)
    {
        return $this->uploadDir . '/' . $this->getUploadedName($key);
    }

    private function broadcasting($bid)
    {
        return $this->uploadDir . '/' . $this->getUploadedName($key);
    }

    private function LowestBid()
    {

    }
}
