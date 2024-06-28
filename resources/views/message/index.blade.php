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
                <a href="{{ route('messages.show', $conversation->id) }}" class="list-group-item list-group-item-action m-2 border">
                    <h5 class="mb-1">
                        {{ $conversation->sender_id === Auth::id() ? 'To: ' . $conversation->receiver->name : 'From: ' . $conversation->sender->name }}
                    </h5>
                    <p class="mb-1">Last message: {{ $conversation->messages()->latest()->first()->message }}</p>
                    <small>{{ $conversation->updated_at }}</small>
                </a>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $conversations->links() }}
        </div>
    @endif
</div>
@endsection

<script>
    Echo.private('messages.' + userId)
        .listen('NewMessage', (e) => {
            console.log('New message received:', e.message);
        });
</script>
