<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use App\Models\ServiceProvider;

class AdminServiceStatusComponent extends Component
{
    public function render()
    {
        $services = Service::all();
        $sproviders = ServiceProvider::all();
        return view('livewire.admin.admin-service-status-component',['services'=>$services,
                                                                        'sproviders'=>$sproviders])->layout('layout.base');
    }
}
