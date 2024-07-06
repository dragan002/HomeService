<?php

namespace App\Slider;

use Illuminate\Support\Carbon;

class ImageSlider {

    public function uploadImageSlider($image): string
    {
        $imageSliderName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
        $image->storeAs('slider/', $imageSliderName, 'public');
        return $image;
    }
}