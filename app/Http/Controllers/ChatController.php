<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function showChatDetail($id)
    {
        $user = Auth::user();
        $chatroom = Chatroom::with(['user1', 'user2', 'chats.sender'])->findOrFail($id);

        if ($chatroom->user_id_1 !== $user->id && $chatroom->user_id_2 !== $user->id) {
            abort(403, 'Unauthorized access to this chatroom.');
        }

        $friends = $chatroom->user_id_1 === $user->id ? $chatroom->user2 : $chatroom->user1;

        Chat::where('chatroom_id', $id)
            ->where('user_id', '!=', $user->id)
            ->update(['seen' => true]);

        $messages = $chatroom->chats;

        return view('chat', compact('messages', 'friends', 'chatroom'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'chatroom_id' => 'required|exists:chatrooms,id',
        ]);

        $user = Auth::user();
        $chatroom = Chatroom::findOrFail($request->chatroom_id);

        if ($chatroom->user_id_1 !== $user->id && $chatroom->user_id_2 !== $user->id) {
            abort(403, 'Unauthorized to send a message in this chatroom.');
        }

        Chat::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => $user->id,
            'message' => htmlspecialchars($request->message), 
            'seen' => false,
        ]);

        return redirect()->route('showChat', ['id' => $chatroom->id]);
    }
    
}