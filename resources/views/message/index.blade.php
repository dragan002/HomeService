@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Conversations</h2>

    @if($conversations->isEmpty())
        <div class="alert alert-info" role="alert">
            No conversations found.
        </div>
    @else
        <div class="list-group">
            @foreach($conversations as $conversation)
                <a href="{{ route('messages.show', $conversation->id) }}" class="list-group-item list-group-item-action my-2 p-4 border rounded shadow-sm">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            {{ $conversation->sender_id === Auth::id() ? 'To: ' . $conversation->receiver->name : 'From: ' . $conversation->sender->name }}
                        </h5>
                        <small class="text-muted">{{ $conversation->updated_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">Last message: {{ $conversation->messages()->latest()->first()->message }}</p>
                </a>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $conversations->links() }}
        </div>
    @endif
</div>
@endsection
