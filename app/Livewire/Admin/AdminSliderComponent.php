<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSliderComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $slides = Slider::paginate(10);
        return view('livewire.admin.admin-slider-component',['slides'=>$slides])->layout('layout.base');
    }
}
