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
                       ->orWhere('sender_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->get();
    return view('messages.index', compact('messages'));
}


    // public function show($id) {
    //     $message = findOrFail($id);

    //     if($message->receiver_id !== Auth::id() $message->sender_id !== Auth::id()) {
    //         abort(403);
    //     }
    //     // if ($message->receiver_id === Auth::id() && !$message->read_at) {
    //     //     $message->read_at = now();
    //     //     $message->save();
    //     // }

    //     return view('messages.show', compact('message'));
    // }

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

    // public function destroy($id) {
    //     $message = findOrFail($id);

    //     if ($message->receiver_id !== Auth::id() && $message->sender_id !== Auth::id()) {
    //         abort(403); 
    //     }
    //     $message->delete();

    //     session()->flash('message', 'Message deleted Successfully');
    //     return redirect()->back();
    // }
}
