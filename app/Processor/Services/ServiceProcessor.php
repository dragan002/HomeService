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

    // public function changeImage($image)
    // {
    // $imageName = Carbon::now()->timestamp . "." . $image->extension();
    // $image->storeAs('services/', $imageName);
    // return $imageName;
    // }

    // public function changeThumbnail($thumbnail)
    // {
    // $thumbnailName = Carbon::now()->timestamp . "." . $thumbnail->extension();
    // $thumbnail->storeAs('services/thumbnails', $thumbnailName);
    // return $thumbnailName;
    // }
}