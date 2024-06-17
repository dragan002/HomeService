<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{       

    public function index() {
    $user = Auth::user();
    $conversations = Conversation::where('receiver_id', $user->id)
                                ->orWhere('sender_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(5);
    return view('message.index', compact('conversations'));
    }

    public function show($id) {
        $conversation = Conversation::findOrFail($id);

        if($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403);
        }
        
        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get();

        return view('message.show', compact('conversation', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::firstOrCreate(
            ['sender_id' => Auth::id(), 'receiver_id' => $request->receiver_id],
            ['sender_id' => Auth::id(), 'receiver_id' =>$request->receiver_id]
        );


        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        session()->flash('message', 'Message Sent Successfully');
        return redirect()->back();
    }

    public function sendAnswer(Request $request, $conversationId) {
        
        $conversation = Conversation::findOrFail($conversationId);
        if($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string'
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $conversation->sender_id === Auth::id() ? $conversation->receiver_id : $conversation->sender_id,
            'message' => $request->message
        ]);
        
        session()->flash('message', 'Reply sent Successfully');
        return redirect()->back();
    }
}
