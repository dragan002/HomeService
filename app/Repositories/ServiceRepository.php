<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface {
    
    public function all() {
        return Service::all();
    }

    public function find($id) {
        return Service::findOrFail($id)
    }

    public function create(array $data) {
        return Service::create($data);
    }

    public function update($id, array $data) {
        $service = Service::findOrFail($data);
        return $service->update($data);
    }

    public function delete($id) {
        $service = Service::findOrFail($id);
        return $service->delete();
    }

}