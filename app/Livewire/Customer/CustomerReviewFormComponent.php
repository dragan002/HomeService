<?php

namespace App\Livewire\Customer;

use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CustomerReviewFormComponent extends Component
{

    public $serviceId;
    public $comment;
    public $rating;

    protected $rules = [
        'comment' => 'required|string',
        'rating' => 'required|integer|min:1|max:5'
    ];

    public function mount($serviceId) {
        $this->serviceId = $serviceId;


        // $this->service = Service::with(['reviews' => function($query) {
        //     $query->take(3);
        // }])->findOrFail($serviceId);
    }

    public function submitReview() {
        $this->validate();

        Review::create([
            'service_id'=> $this->serviceId,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
            'rating' => $this->rating
        ]);

        session()->flash('message', 'Reviews submitted successfully');
        $this->reset([
            'comment',
            'rating'
        ]);
    }
    public function render()
    {
        return view('livewire.customer.customer-review-form-component')->layout('layout.base');
    }
}
