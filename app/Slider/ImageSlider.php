<?php

namespace App\Slider;

use Illuminate\Support\Carbon;

class ImageSlider {

    public function uploadImageSlider($file, string $type): string
    {
        $imageSliderName = Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $imageSliderName);
        return $imageSliderName;
    }
}