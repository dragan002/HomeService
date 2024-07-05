<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageServices {

    public function uploadImage($file, string $type): string
    {
        $imageName = Carbon::now()->timestamp . $type . '.' . $file->getClientOriginalExtension();
        $file->storeAs('services/' . ($type === 'thumbnail' ? 'thumbnails' : ''), $imageName);
        return $imageName;
    }

    public function uploadImageCategory($file, string $type): string 
    {
        $imageName = Carbon::now()->timestamp . $type . '.' . $file->getClientOriginalExtension();
        $file->storeAs('categories/' . ($type === 'categoryImage' ? '' : ''), $imageName);
        return $imageName;
    }
    
    // ====== FOR AdminEditServiceComponent ====
    public function changeImage($service, $image)
    {
        if (file_exists('images/services' . '/' . $service->image)) {
            unlink('images/services' . '/' . $service->image);
        }
        $imageName = Carbon::now()->timestamp . "." . $image->extension();
        $image->storeAs('services/', $imageName);
        return $imageName;
    }
    
    public function changeThumbnail($service, $thumbnail)
    {
        if (file_exists('images/services/thumbnails' . '/' . $service->thumbnail)) {
            unlink('images/services/thumbnails' . '/' . $service->thumbnail);
        }
        $thumbnailName = Carbon::now()->timestamp . "." . $thumbnail->extension();
        $thumbnail->storeAs('services/thumbnails', $thumbnailName);
        return $thumbnailName;
    }
}
