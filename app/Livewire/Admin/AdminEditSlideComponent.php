<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Carbon;
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
        $slider = Slider::find( $this->slide_id);
        $slider->title = $this->title;
        $slider->status = $this->status;

        if($this->newImage) {
            unlink('images/slider' . '/' . $slider->image);
            $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
            $this->newImage->storeAs('slider/', $imageName);
            $this->image = $imageName;
        }
        $slider->save();
        session()->flash('message', 'Slider has been updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component')->layout('layout.base');
    }
}
