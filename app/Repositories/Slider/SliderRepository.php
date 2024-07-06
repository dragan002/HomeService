<?php

namespace App\Repositories\Slider;

use App\Models\Slider;

class SliderRepository 
{
    public function createNewSlide(array $data): Slider
    {
        return Slider::create($data);
    }

    public function updateSlider(Slider $slider, array $data): void 
    {
        $slider->update($data);
    }

    public function saveSlider(Slider $slider, string $title, string $image, string $status, $imageSliderName)
    {
        $slider->title = $title;
        $slider->image = $image;
        $slider->image = $imageSliderName;
        $slider->status = $status;
        $slider->save();
    }

}