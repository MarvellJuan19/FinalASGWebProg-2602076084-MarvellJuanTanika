<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Chatroom;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    public function showHomePage(Request $request)
{
    $genders = ['male', 'female'];

    $query = User::where('id', '!=', Auth::id());

    $friendIds = Friend::where('status', 'Accepted')
        ->where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })
        ->get()
        ->flatMap(function($friendship) {
            return [$friendship->sender_id, $friendship->receiver_id];
        })
        ->unique()
        ->filter(function($id) {
            return $id != Auth::id();
        })
        ->toArray();

    $query->whereNotIn('id', $friendIds);

    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->has('gender') && !empty($request->gender)) {
        $query->where('gender', $request->gender);
    }

    $users = $query->where('visibility', true)->get();

    return view('home', compact('users', 'genders'));
}

    

    public function showFriendsPage()
    {
        $user = Auth::user();
        $acceptedFriends = Friend::where('status', 'Accepted')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver'])
            ->get();
    
        $pendingRequests = Friend::where('status', 'Pending')
            ->where('receiver_id', $user->id)
            ->with('sender')
            ->get();
    
        return view('friend', compact('acceptedFriends', 'pendingRequests'));
    }

    public function showChatPage()
    {
        $user = Auth::user();
        $chatrooms = Chatroom::with(['user1', 'user2'])
            ->where('user_id_1', $user->id)
            ->orWhere('user_id_2', $user->id)
            ->get();

        return view('chatroom', compact('chatrooms'));
    }

    public function showTopUpPage()
    {
        $user = Auth::user();
        return view('topup', compact('user'));
    }

    public function showNotifications()
    {
        $user = Auth::user();

        $friendRequests = Friend::where('receiver_id', $user->id)
            ->where('status', 'Pending')
            ->get();

        $chatNotifications = Chat::whereHas('chatroom', function ($query) use ($user) {
            $query->where('user_id_1', $user->id)
                  ->orWhere('user_id_2', $user->id);
        })
        ->where('user_id', '!=', $user->id)
        ->where('seen', false)
        ->get();

        Friend::where('receiver_id', $user->id)
            ->where('status', 'Pending')
            ->update(['seen' => true]);

        Chat::whereHas('chatroom', function ($query) use ($user) {
            $query->where('user_id_1', $user->id)
                  ->orWhere('user_id_2', $user->id);
        })
        ->where('user_id', '!=', $user->id)
        ->where('seen', false)
        ->update(['seen' => true]);

        return view('notification', compact('friendRequests', 'chatNotifications'));
    }

}