<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($serviceId) {
        $service =Service::findOrFail($serviceId);
        return view('bookings.create'), compact('service');
    }

    public function store(Request $request, $serviceId) {
        
        $request->validate() {
            'booking_time' => 'required|date|after:now'
        }

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $serviceId,
            'booking_time' => $request->booking_time,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.index')->with('message', 'Booking created successfully');
    }
    public function indes() {
        $bookings = Booking::where('user_id', Auth::id())->orderBy('booking_time', 'asc')->get();
        return view('bookings.index'), compact('bookings');
    }
}
