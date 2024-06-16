<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{       

    public function index() {
    $user = Auth::user();
    $messages = Message::where('receiver_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->paginate(5);
    return view('message.index', compact('messages'));
}

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        session()->flash('message', 'Message Sent Successfully');
        return redirect()->back();
    }

    public function sendAnswer(Request $request, $messageId) {
        
        $request->validate([
            'message' => 'required|string'
        ]);

        $originalMessage = Message::findOrFail($messageId);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $originalMessage->sender_id,
            'message' => $request->message
        ]);
        
        session()->flash('message', 'Reply sent Successfully');
        return redirect()->back();
    }
}
