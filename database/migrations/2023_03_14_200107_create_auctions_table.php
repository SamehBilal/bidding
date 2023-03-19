<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->set('type',['tbased','pbased','altomo']);
            $table->bigInteger('starting_bid');
            $table->bigInteger('highest_bid');
            $table->bigInteger('desired_price')->nullable();
            $table->bigInteger('bid_ratio');
            $table->datetime('starting_time');
            $table->datetime('ending_time');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
