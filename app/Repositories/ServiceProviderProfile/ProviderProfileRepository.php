<?php

namespace App\Repositories\ServiceProviderProfile;

use Illuminate\Support\Carbon;
use App\Models\ServiceProvider;

class ProviderProfileRepository
{
    public function updateProviderProfile(ServiceProvider $serviceProvider, string $about, string $city, string $serviceCategoryId, string $serviceLocations, string $imageName)
    {
        $serviceProvider->about                 = $about;
        $serviceProvider->city                  = $city;
        $serviceProvider->service_category_id   = $serviceCategoryId;
        $serviceProvider->service_locations     = $serviceLocations;
        $serviceProvider->image                 = $imageName;
        $serviceProvider->save();
    }

    public function changeProviderImage()
    {
        $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
        $this->newImage->storeAs('sproviders', $imageName);
        $serviceProvider->image = $imageName;  
    }
}