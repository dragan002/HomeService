@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Bookings</h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Customer</th>
                    <th>Booking Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->booking_time }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            @if ($booking->status == 'pending')
                                <form action="{{ route('sprovider.bookingsUpdate', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="confirmed" class="btn btn-success btn-sm">Confirm</button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @else
                                <span>{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
