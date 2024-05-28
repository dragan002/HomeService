<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class HomeComponent extends Component
{
    public function render()
    {
        $scategories = ServiceCategory::inRandomOrder()->take(18)->get();
        return view('livewire.home-component',['scategories'=> $scategories])->layout('layout.base');
    }
}
