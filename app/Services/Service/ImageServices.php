<?php

namespace App\Services\Service;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageServices {

    public function uploadImage($file, string $type): string
    {
        $imageName = Carbon::now()->timestamp . $type . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('services/' . ($type === 'thumbnail' ? 'thumbnails' : ''), $file, $imageName);
        return $imageName;
    }

    public function uploadImageCategory($file, string $type): string 
    {
        $imageName = Carbon::now()->timestamp . $type . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('categories/' . ($type === 'categoryImage' ? '' : ''), $file, $imageName);
        return $imageName;
    }

    public function changeCategoryImage($serviceCategory, $image)
    {
        if (Storage::exists('categories/' . $serviceCategory->image)) {
            Storage::delete('categories/' . $serviceCategory->image);
        }

        $imageName = Carbon::now()->timestamp . "." . $image->extension();
        Storage::putFileAs('categories/', $image, $imageName);
        return $imageName;
    }
    
    // ====== FOR AdminEditServiceComponent ====
    public function changeImage($service, $image)
    {
        if (Storage::exists('services/' . $service->image)) {
            Storage::delete('services/' . $service->image);
        }

        $imageName = Carbon::now()->timestamp . "." . $image->extension();
        Storage::putFileAs('services/', $image, $imageName);
        return $imageName;
    }
    
    public function changeThumbnail($service, $thumbnail)
    {
        if (Storage::exists('services/thumbnails/' . $service->thumbnail)) {
            Storage::delete('services/thumbnails/' . $service->thumbnail);
        }
        
        $thumbnailName = Carbon::now()->timestamp . "." . $thumbnail->extension();
        Storage::putFileAs('services/thumbnails', $thumbnail, $thumbnailName);
        return $thumbnailName;
    }
}