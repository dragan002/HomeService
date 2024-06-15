@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Inbox</h2>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <ul class="list-group">
            @forelse ($messages as $message)
                <li class="list-group-item">
                    {{-- <a href="{{ route('message.show', $message->id) }}"> --}}
                        {{ $message->message }}
                    </a>
                </li>
            @empty
                <li class="list-group-item">No messages</li>
            @endforelse
        </ul>
    </div>
@endsection
