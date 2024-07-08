<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;

class ServiceRepository {

    public function createService(array $data): Service
    {
        return Service::create($data);
    }

    public function saveService(Service $service, string $imageName, string $thumbnailName) 
    {
        $service->image     = $imageName;
        $service->thumbnail = $thumbnailName;
        $service->save();
    }

    public function updateService(Service $service, array $data): void
    {
        $service->update($data);
    }

    public function deleteServiceById($id): bool
    {
        $service = Service::find($id);
        if(!$service) {
            return false;
        }
        if($service->image) {
            Storage::delete('images/services/' . $service->image);
        }
        if($service->thumbnail) {
            Storage::delete('images/services/thumbnails' . $service->thumbnail);
        }
        $service->delete();
        return true;
    }
    
    public function paginateService($perPage = 10) 
    {
        return Service::paginate($perPage);
    }
}