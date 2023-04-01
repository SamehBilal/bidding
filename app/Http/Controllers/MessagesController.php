<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function store(Request $request,Auction $auction){
        if($request->message)
        {
            $message = Message::create([
                'message'           => $request->message,
                'user_id'           => $request->user,
                'auction_id'        => $auction->id,
            ]);

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

            $user = User::findOrFail($message->user_id);

            $data = [
                'message' => $message->message,
                'name' => $user->name,
                'user_id' => $user->id,
                'created_at' => $message->created_at->diffForHumans(),
                'status' => true,
            ];

            $pusher->trigger('chat.'.$auction->id, 'App\\Events\\ChatEvent', $data);

            return $data;
        }
    }
}
