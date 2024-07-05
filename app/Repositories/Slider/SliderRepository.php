<?php

namespace App\Repositories\Slider;

use App\Models\Slider;

class SliderRepository 
{
    public function createNewSlide(array $data): Slider
    {
        return Slider::create($data);
    }

    public function saveSlider(Slider $slider, string $name, string $image, string $status)
    {
        $slider->title = $title;
        $slider->image = $image;
        $slider->status = $status;
        $slider->save();
    }

}