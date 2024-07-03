<?php

namespace App\Repositories\Service;

use App\Models\Service;

class ServiceRepository {
    
    public function createService(array $data): Service
    {
        return Service::create($data);
    }

    public function setServiceImagesNamesAndSave(Service $service, string $imageName, string $thumbnailName) 
    {
        $service->image = $imageName;
        $service->thumbnail = $thumbnailName;
        $service->save();
    }

    public function updateService(Service $service, array $data): void
    {
        $service->update($data);
    }

    public function deleteService(Service $service): void 
    {
        $service->delete();
    }
}