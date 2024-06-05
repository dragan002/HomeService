<?php

namespace App\Livewire\Sprovider;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceProvider;

class SproviderServicesListComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $sproviders = ServiceProvider::where('user_id', auth()->id())->paginate(10);
        return view('livewire.sprovider.sprovider-services-list-component', ['sproviders'=>$sproviders])->layout('layout.base');
    }
}
