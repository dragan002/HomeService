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
        $service = Service::where('slug', $this->service_slug);
        return view('livewire.service-details-component', ['service'=>$service])->layout('layout.base');
    }
}
