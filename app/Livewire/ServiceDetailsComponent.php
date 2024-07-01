<?php
namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceDetailsComponent extends Component
{
    public $serviceSlug;

    public function mount($serviceSlug) {
        $this->serviceSlug = $serviceSlug;
    }

    public function render()
    {
        // Fetch the service by slug
        $service = Service::where('slug', $this->serviceSlug)->firstOrFail();

        // Fetch a related service from the same category, excluding the current service
        $r_service = Service::where('service_category_id', $service->service_category_id)
            ->where('slug', '!=', $this->serviceSlug)
            ->inRandomOrder()
            ->first();

        return view('livewire.service-details-component', [
            'service' => $service,
            'r_service' => $r_service
        ])->layout('layout.base');
    }
}
