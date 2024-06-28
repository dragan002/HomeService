@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Conversation with {{ $conversation->sender_id === Auth::id() ? $conversation->receiver->name : $conversation->sender->name }}</h2>

    @if($messages->isEmpty())
        <div class="alert alert-info" role="alert">
            No messages found.
        </div>
    @else
        @foreach($messages as $message)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $message->sender->name }}</h5>
                    <p class="card-text">{{ $message->message }}</p>
                    <p class="card-text"><small class="text-muted">{{ $message->created_at->format('Y-m-d H:i:s') }}</small></p>
                </div>
            </div>
        @endforeach
    @endif

    <form action="{{ route('message.reply', $conversation->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send Reply</button>
    </form>
</div>
@endsection
