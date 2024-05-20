<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ServiceCategoriesComponent extends Component
{
    public function render()
    {
        $scategories = ServiceCategory::all();
        return view('livewire.service-categories-component', ['scategories' => $scategories])->layout('layout.base');
    }
}
