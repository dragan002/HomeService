<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminEditSlideComponent extends Component
{
    use WithFileUploads;

    public $slideId;
    public $title;
    public $image;  
    public $status;
    public $newImage;

    public function mount($slideId) {
        $slide = Slider::find($slideId);
        $this->slideId = $slide->id;
        $this->title = $slide->title;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            "title"=> 'required',
            "status" => 'required',
        ]);
        if($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpg,png,jpeg'
            ]);
        }
    }

    public function updateSlider() {
        $this->validate([
            'title'=> 'required',
            'status'=> 'required'
        ]);
        if($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpg,png,jpeg'
            ]);
        }

        $slide = Slider::find($this->slideId);
        $slide->title = $this->title;
        $slide->status = $this->status;

        if($this->newImage) {
            if (file_exists(public_path('images/slider/' . $slide->image))) {
                unlink(public_path('images/slider/' . $slide->image));
            }
            $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
            $this->newImage->storeAs('slider', $imageName);
            $slide->image = $imageName;
        }
        $slide->save();
        session()->flash('message', 'Slide has been updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component')->layout('layout.base');
    }
}
