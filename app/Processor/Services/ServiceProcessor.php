<?php

namespace App\Processor\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class ServiceProcessor 
{
    public function validateData(array $data) 
    {
        return validator($data, [
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg',
            'thumbnail' => 'required|mimes:png,jpg',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
        ])->validate();
    }

    public function generateSlug(string $name): string
    {
        return Str::slug($name, '-');
    }

    public function uploadImage($file, string $type): string
    {
        $imageName = Carbon::now()->timestamp . $type . '.' . $file->getClientOriginalExtension();
        $file->storeAs('services/' . ($type === 'thumbnail' ? 'thumbnails' : ''), $imageName);
        return $imageName;
    }

    // ====== FOR AdminEditServiceComponent ====
    public function changeImage($image)
    {
        if(file_exists('images/services' . '/' . $service->image)) {
            unlink('images/services' . '/' . $service->image);
        }
        $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
        $this->newImage->storeAs('services/', $imageName);
        $service->image = $imageName;
    }

    public function changeThumbnail($thumbnail)
    {
        if(file_exists('images/services/thumbnails' . '/' . $service->thumbnail)) {
            unlink('images/services/thumbnails' . '/' . $service->thumbnail);
        }
        $thumbnailName = Carbon::now()->timestamp . "." . $this->newThumbnail->extension();
        $this->newThumbnail->storeAs('services/thumbnails', $thumbnailName);
        $service->thumbnail = $thumbnailName;
    }
}