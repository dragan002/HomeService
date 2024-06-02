<?php

namespace App\Livewire\Sprovider;

use Livewire\Component;

class EditSproviderProfileComponent extends Component
{
    public $service_provider_id;
    public $image;
    public $about;
    public $city;
    public $service_category_id;
    public $service_locations;
    public $newImage;

    public function render()
    {
        return view('livewire.sprovider.edit-sprovider-profile-component')->layout('layout.base');
    }
}
