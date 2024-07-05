<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use App\Slider\ImageSlider;
use livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Session;
use App\Repositories\Slider\SliderRepository;

class AdminAddSlideComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $status = 0;

    protected $sliderRepository;
    protected $imageSlider;
    protected $validator;

    public function __construct()
    {
        $this->sliderRepository = new SliderRepository;
        $this->imageSlider = new ImageSlider;
        $this->validator = new ServiceValidator;
    }

    public function addNewSlide(): void 
    {
        $data = [
            'title' => $this->title,
            'image' => $this->image,
            'status' => $this->status,
        ];

        $this->validator->validate($data);

        try {
            $slider = $this->sliderRepository->createNewSlide($data);
            $imageSliderName = $this->imageSlider->uploadImageSlider($this->image, 'sliderImage');
            $data['image'] = $imageSliderName;  // Update image path in data
            $this->sliderRepository->saveSlider($slider, $this->title, $this->image, $this->status);

            Session::flash('message', 'Slider has been created successfully');
        } catch (\Exception $e) {
            \Log::error("Error creating slide: {$e->getMessage()}", [
                'request_data' => $data,
                'slider_object' => $slider ?? null,
                'image_slider_name' => $imageSliderName ?? null,
                'title' => $this->title ?? null,
                'image' => $this->image ?? null,
                'status' => $this->status ?? null,
            ]);
        
            // Get the error code and message
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
        
            // Log the error code and message separately
            \Log::error("Error code: $errorCode");
            \Log::error("Error message: $errorMessage");
        
            // Get the stack trace
            $stackTrace = $e->getTraceAsString();
            \Log::error("Stack trace: $stackTrace");
        
            Session::flash('error', 'An error occured while creating the slide');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-add-slide-component')->layout('layout.base');
    }
}
