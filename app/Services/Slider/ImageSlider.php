<?php
namespace App\Services\Slider;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageSlider
{
    public function uploadImageSlider(UploadedFile $image): string
    {
        if (!$image->isValid()) {
            throw new \InvalidArgumentException('Invalid file uploaded');
        }

        $imageSliderName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();

        try {
            Storage::putFileAs('slider/', $image, $imageSliderName);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Failed to upload image');
        }

        return $imageSliderName;
    }

    public function changeSlideImage($slider, UploadedFile $newImage)
    {
        if(Storage::exists('slider/' . $slider->image)) {
            Storage::delete('slider/' . $slider->image);
        }
    
        $imageSliderName = Carbon::now()->timestamp . '.' . $newImage->getClientOriginalExtension();
        Storage::putFileAs('slider/', $newImage, $imageSliderName);
        
        return $imageSliderName;
    }
}
