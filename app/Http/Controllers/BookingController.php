<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingStatusChanged;

class BookingController extends Controller
{
    public function create($serviceId) {
        $service =Service::findOrFail($serviceId);
        return view('bookings.create', compact('service'));
    }

    public function store(Request $request, $serviceId) {
        
        $request->validate([
            'booking_time' => 'required|date',
        ]); 

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $serviceId,
            'booking_time' => $request->booking_time,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.index')->with('message', 'Booking created successfully');
    }
    public function index() {
        $bookings = Booking::where('user_id', Auth::id())->orderBy('booking_time', 'asc')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function manage () {
        $bookings = Booking::whereHas('service', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('booking_time', 'asc')->get();

        return view('bookings.manage', compact('bookings'));
    }

    public function update(Request $request, $id) {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        // notification for booking
        $booking->user->notify(new BookingStatusChanged($booking, $request->status));
        return redirect()->route('sprovider.bookingManage')->with('message', 'Booking Status Updated Successfully');    }
}
