<?php

namespace App\Repositories\ServiceProviderProfile;

use Illuminate\Support\Carbon;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class ProviderProfileRepository
{
    public function updateProviderProfile(ServiceProvider $serviceProvider, array $data)
    {
     $serviceProvider->update($data);
    }

    public function changeProviderImage($serviceProvider, $newImage)
    {
        if (Storage::exists('sproviders/' . $serviceProvider->image)) {
            Storage::delete('sproviders/' . $serviceProvider->image);
        }

        $imageName = Carbon::now()->timestamp . "." . $newImage->extension();
        Storage::putFileAs('sproviders/', $newImage, $imageName);
        return $imageName;
    }
}
