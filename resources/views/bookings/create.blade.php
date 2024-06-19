@extends('layouts.app');

@section('content');

<div class="container">
    <h1>Book Service {{ $service->name }}</h1>
    <form action="{{ route('bookings.store', $service->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="booking_time">Booking Time:</label>
            <input type="datetime-local" name="booking_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

@endsection