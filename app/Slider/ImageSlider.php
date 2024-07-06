<?php
namespace App\Slider;

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
            Storage::putFileAs('slider', $image, $imageSliderName);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Failed to upload image');
        }

        return $imageSliderName;
    }
}
