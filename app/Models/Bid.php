<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function auction()
    {
        return $this->hasOne(Auction::class,'id','auction_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public static function rules()
    {
        return [
            'bid_amount'          => "required|numeric",
        ];
    }
}
