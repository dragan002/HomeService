<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceProvider;

class ProvidersProfileInformationComponent extends Component
{

    public $userId;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function render()
    {   
        $sprovider = ServiceProvider::where('user_id', $this->userId)->first();
        return view('livewire.providers-profile-information-component',['sprovider'=> $sprovider])->layout('layout.base');
    }
}
