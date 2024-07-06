<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\Slider\ImageSlider;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Session;
use App\Repositories\Slider\SliderRepository;


class AdminEditSlideComponent extends Component
{
    use WithFileUploads;

    public $id;
    public $title;
    public $image;  
    public $status;
    public $newImage;

    protected $sliderRepository;
    protected $imageSlider;
    protected $validator;

    public function __construct()
    {
        $this->sliderRepository = new SliderRepository;
        $this->imageSlider = new ImageSlider;
        $this->validator = new ServiceValidator;
    }

    public function mount($id)
    {
        $slider = Slider::findOrFail($id);

        $this->id = $slider->id;
        $this->title = $slider->title;
        $this->image = $slider->image;
        $this->status = $slider->status;
    }

    public function updateSlide()
    {
        $data = [
            'title'     => $this->title,
            'image'     => $this->image,
            'status'    => $this->status,
        ];

        $this->validator->validate($data);

        try {
            $slider = Slider::findOrFail($this->id);

            $slider->title = $this->title;
            $slider->image = $this->image;
            $slider->status = $this->status;

            if($this->newImage) {
                $imageSlideName = $this->imageSlider->changeSlideImage($slider, $this->newImage);
                $slider->image = $imageSlideName;
            }

            $this->sliderRepository->updateSlider($slider, $slider->toArray());

            Session::flash('message', 'Slider has been updated successfully');
        } catch(\Exception $e) {
        \Log::error('Error updating service: ' . $e->getMessage());
        Session::flash('error', 'An error occurred while updating the Service.');
    }
}

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component' )->layout('layout.base');
    }
}
