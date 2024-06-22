@extends('layouts')

@section('content')
    <div class="container">
        <h1>Your Notification</h1>
        <ul class="list-group">
            @foreach(auth()->user()->notications as $notification)
                <li class="list-group-item">
                    <a href="{{ route('bookings.index') }}">
                        {{ $notification->data['message'] }}
                    </a>
                    <span class="badge">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection