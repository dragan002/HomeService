<?php

namespace App\Services;

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
}