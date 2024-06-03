<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceProvider;

class AdminServiceProvidersComponent extends Component
{
    public function render()
    {
        $sproviders = ServiceProvider::paginate(12);
        return view('livewire.admin.admin-service-providers-component', ['sproviders'=>$sproviders])->layout('layout.base');
    }
}
