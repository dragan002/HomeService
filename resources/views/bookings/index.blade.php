@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Your Booking</h1>
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Service</th>
                    <th class="text-center">Booking Time</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td class="text-center">{{ $booking->service->name }}</td>
                        <td class="text-center">{{ $booking->booking_time }}</td>
                        <td class="text-center">
                            @if($booking->status == 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($booking->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-secondary">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        background: linear-gradient(145deg, #e3f2fd, #bbdefb);
    }
    thead {
        background: linear-gradient(145deg, #2196f3, #1e88e5);
    }
    thead th {
        color: #fff;
    }
    tbody tr {
        transition: background-color 0.3s;
    }
    tbody tr:hover {
        background-color: #f1f1f1;
    }
    .badge-success {
        background-color: #28a745;
    }
    .badge-warning {
        background-color: #ffc107;
    }
    .badge-secondary {
        background-color: #6c757d;
    }
</style>

@endsection
