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
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $message->sender->name }}</h5>
                        <small class="text-muted">{{ $message->created_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                    <hr>
                    <p class="card-text">{{ $message->message }}</p>
                </div>
            </div>
        @endforeach
    @endif

    <form action="{{ route('messages.reply', $conversation->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group mb-3">
            <label for="message">Reply</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Reply</button>
    </form>
</div>
@endsection
