<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function addFriend($id)
    {
        $existingRequest = Friend::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)->where('receiver_id', Auth::id());
        })->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You have already sent a friend request or are already friends.');
        }

        Friend::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $id,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Friend request sent successfully.');
    }

    public function acceptFriend($id)
    {

        $friendship = Friend::find($id);
        $currUser = Auth::user();

        if ($friendship && $friendship->status === 'Pending' && $friendship->receiver_id === Auth::id()) {
            $friendship->status = 'Accepted';
            $friendship->save();

            Chatroom::create([
                'user_id_1' => $friendship->sender_id, 
                'user_id_2' => $friendship->receiver_id, 
            ]);

            return redirect()->back()->with('success', 'Friend request accepted.');
        }

        return redirect()->back()->with('error', 'Invalid friend request.');
    }

    public function declineFriend($id)
    {
        $friendship = Friend::find($id);

        if ($friendship && $friendship->status === 'Pending' && $friendship->receiver_id === Auth::id()) {
            $friendship->delete();

            return redirect()->back()->with('success', 'Friend request declined.');
        }

        return redirect()->back()->with('error', 'Friend request not found or already handled.');
    }
}