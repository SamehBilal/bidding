<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public function auction()
    {
        return $this->hasOne(Auction::class,'id','auction_id');
    }

    public static function rules()
    {
        return [
            'bid_amount'          => "required|numeric",
        ];
    }
}
