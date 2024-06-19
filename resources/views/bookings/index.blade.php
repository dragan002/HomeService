@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Your Booking</h1>
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Booking Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->booking_time }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </div>
</div>
@endsection