<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Notification::create([
        //     'user_id' => $booking->user_id,
        //     'type' => 'booking_status',
        //     'data' => [
        //         'message' => 'Your booking for ' . $booking->service->name . ' has been ' . $request->status . '.',
        //     ],
        //     'read' => false,
        // ]);
        // Mail::to($receiver->email)->send(new NewMessageNotification($message, $sender));

        return redirect()->route('bookings.manage')->with('message', 'Booking Status Updated Successfully');
    }
}
