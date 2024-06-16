@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Inbox</h2>

    @if($messages->isEmpty())
        <div class="alert alert-info" role="alert">
            No messages found.
        </div>
    @else
        <p class="mb-4">Messages found: {{ $messages->total() }}</p>
        
        @foreach($messages as $message)
            <div class="card mb-3 border-primary">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="text-primary">To: {{ $message->receiver->name }}</span><br>
                        <span class="text-success">From: {{ $message->sender->name }}</span>
                    </h5>
                    <p class="card-text">{{ Str::limit($message->message, 50) }}</p>
                    <a href="{{ route('message.show', $message->id) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                    <p class="text-muted small mt-2">{{ $message->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $messages->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection