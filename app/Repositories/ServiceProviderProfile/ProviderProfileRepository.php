<?php

namespace App\Repositories\ServiceProviderProfile;

use Illuminate\Support\Carbon;
use App\Models\ServiceProvider;

class ProviderProfileRepository
{
    public function updateProviderProfile(ServiceProvider $serviceProvider, array $data)
    {
        $serviceProvider->about                 = $data['about'];
        $serviceProvider->city                  = $data['city'];
        $serviceProvider->service_category_id   = $data['service_category_id'];
        $serviceProvider->service_locations     = $data['service_locations'];
        $serviceProvider->image                 = $data['image'];
        $serviceProvider->save();
    }

    public function changeProviderImage($serviceProvider, $newImage)
    {
        $imageName = Carbon::now()->timestamp . '.' . $newImage->extension();
        $newImage->storeAs('sproviders', $imageName);
        $serviceProvider->image = $imageName;  
    }
}