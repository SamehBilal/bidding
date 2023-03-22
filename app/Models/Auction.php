<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'starting_time'=>'datetime',
        'ending_time'=>'datetime',
    ];

    public function bid()
    {
        return $this->hasMany(Bid::class)->orderByDesc('id');
    }

    public static function rules($update = false, $id = null)
    {
        return [
            'type'              => 'required',Rule::in(['tbased','pbased','altomo']),
            'starting_bid'      => "required|numeric|gt:0",
            'highest_bid'       => "nullable|numeric|gt:0",
            'bid_ratio'         => "nullable|numeric|gt:0",
            'desired_price'     => "required_if:type,==,pbased|numeric|gt:0",
            'starting_time'     => "required|date_format:Y-m-d|after_or_equal:now",
            'ending_time'       => "required|date_format:Y-m-d|after:starting_time",
        ];
    }
}
