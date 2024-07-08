<?php

namespace App\Repositories\ServiceCategories;

use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryRepository {


    public function createServiceCategory(array $data): ServiceCategory
    {
        return ServiceCategory::create($data);
    }

    public function updateServiceCategory(ServiceCategory $serviceCategory, array $data): void
    {
        $serviceCategory->update($data);
    }

    public function saveServiceCategory(ServiceCategory $serviceCategory, string $name, string $slug, string $imageName)
    {
        $serviceCategory->name  = $name;
        $serviceCategory->slug  = $slug;
        $serviceCategory->image = $imageName;
        $serviceCategory->save();
    }

    public function deleteServiceCategoryById($id): bool
    {
        $scategory = ServiceCategory::find($id);
        if(!$scategory) {
            return false;
        }
        if($scategory->image) {
            Storage::delete('images/categories', $scategory->image);
        }
        $scategory->delete();
        return true;
    }

    public function paginateServiceCategory($perPage = 10)
    {
        return ServiceCategory::paginate($perPage);
    }
}