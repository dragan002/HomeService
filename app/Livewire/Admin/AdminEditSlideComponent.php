<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSlideComponent extends Component
{
    use WithFileUploads;

    public $slide_id;
    public $title;
    public $image;
    public $status;
    public $newImage;

    public function mount($slide_id) {
        $sliders = Slider::find($slide_id);
        $this->slide_id = $sliders->id;
        $this->title = $sliders->title;
        $this->image = $sliders->image;
        $this->status = $sliders->status;
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component')->layout('layout.base');
    }
}
