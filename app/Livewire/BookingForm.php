<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookingForm extends Component
{
    public function render()
    {
        public $serviceId;
        public $date;
        public $time;

        protected $rules = [
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required'
        ];

        public function mount($serviceId) {
            $this->serviceId = $serviceId;
        }

        public function bookService() {
            $this->validate();

            Booking::create([
                'service_id' = > $this->serviceId,
                'user_id' => Auth::id(),
                'date' => $this->date,
                'time' => $this->time,
                'status' => 'pending'
            ]);

            session()->flash('message', 'Service Booked Successfully');

            // return  redirect()->route('customer.booking_list', $this->serviceId);
        }
        $service = Service::findOrFail($this->serviceId);
        return view('livewire.booking-form', compact('service'));
    }
}
