<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        /* Auctions */
        $auctions = [
            ['type' => 'tbased',     'starting_bid' => '600',     'highest_bid' => 600,   'bid_ratio' => 10,   'starting_time' => now(),       'ending_time' => date("Y-m-d H:i:s", strtotime("tomorrow")),     'created_at' => now()],
            ['type' => 'tbased',     'starting_bid' => '600',     'highest_bid' => 600,   'bid_ratio' => 20,   'starting_time' => now(),       'ending_time' => date("Y-m-d H:i:s", strtotime("tomorrow")),     'created_at' => now()],
            ['type' => 'pbased',     'starting_bid' => '600',     'highest_bid' => 600,   'bid_ratio' => 10,   'starting_time' => now(),       'ending_time' => date("Y-m-d H:i:s", strtotime("tomorrow")),     'created_at' => now()],
            ['type' => 'altomo',     'starting_bid' => '600',     'highest_bid' => 600,   'bid_ratio' => 25,   'starting_time' => now(),       'ending_time' => date("Y-m-d H:i:s", strtotime("tomorrow")),     'created_at' => now()],
        ];

        \Illuminate\Support\Facades\DB::table('auctions')->insert($auctions);

        /* Bids */
        $bids = [
            ['bid_amount' => '600',     'auction_id' => 1,     'user_id' => 1,    'created_at' => now()],
            ['bid_amount' => '600',     'auction_id' => 2,     'user_id' => 2,    'created_at' => now()],
            ['bid_amount' => '600',     'auction_id' => 3,     'user_id' => 3,    'created_at' => now()],
            ['bid_amount' => '600',     'auction_id' => 4,     'user_id' => 4,    'created_at' => now()],
        ];

        \Illuminate\Support\Facades\DB::table('bids')->insert($bids);
    }
}
