<?php
namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceDetailsComponent extends Component
{
    public $service_slug;

    public function mount($service_slug) {
        $this->service_slug = $service_slug;
    }

    public function render()
    {
        // Fetch the service by slug
        $service = Service::where('slug', $this->service_slug)->firstOrFail();

        // Fetch a related service from the same category, excluding the current service
        $r_service = Service::where('service_category_id', $service->service_category_id)
            ->where('slug', '!=', $this->service_slug)
            ->inRandomOrder()
            ->first();

        return view('livewire.service-details-component', [
            'service' => $service,
            'r_service' => $r_service
        ])->layout('layout.base');
    }
}
