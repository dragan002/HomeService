<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMessageNotification;


class MessageController extends Controller
{       
    public $message;
    
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
            ['sender_id' => Auth::id(), 'receiver_id' => $request->receiver_id],
        );
    
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
    
        // Retrieve the sender and receiver
        $sender = Auth::user();
        $receiver = User::find($request->receiver_id);
    
        // Send the email notification
        Mail::to($receiver->email)->send(new NewMessageNotification($message, $sender));
        
        session()->flash('message', 'Message Sent Successfully');
        return redirect()->back();
    }
    

    public function sendAnswer(Request $request, $conversationId) {
        $conversation = Conversation::findOrFail($conversationId);
    
        // Check if the authenticated user is a participant in the conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403); // or handle unauthorized access appropriately
        }
    
        $request->validate([
            'message' => 'required|string'
        ]);
    
        // Create a new message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $conversation->sender_id === Auth::id() ? $conversation->receiver_id : $conversation->sender_id,
            'message' => $request->message
        ]);
    
        // Retrieve the sender and receiver
        $sender = Auth::user();
        $receiver = User::find($message->receiver_id); 
    
        // Check if receiver exists
        if (!$receiver) {
            abort(404); 
        }
    
        // Send the email notification
        Mail::to($receiver->email)->send(new NewMessageNotification($message, $sender));
    
        session()->flash('message', 'Reply sent Successfully');
        return redirect()->back();
    }
    
}
