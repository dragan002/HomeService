<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Helpers\ServiceHelpers;
use App\Models\ServiceCategory;
use App\Validators\ServiceValidator;
use App\Services\Service\ImageServices;
use Illuminate\Support\Facades\Session;
use App\Repositories\ServiceCategories\ServiceCategoryRepository;

class AdminEditServiceCategoryComponent extends Component
{
    use WithFileUploads;

    public $id;
    public $name;
    public $slug;
    public $image;
    public $featured;
    public $newImage;

    protected $serviceCategoryRepository;
    protected $serviceHelpers;
    protected $imageServices;
    protected $validator;

    public function __construct() 
    {
        $this->serviceCategoryRepository    = new ServiceCategoryRepository();
        $this->serviceHelpers               = new ServiceHelpers;
        $this->imageServices                = new ImageServices;
        $this->validator                    = new ServiceValidator;
    }

    public function mount($id) {

        $serviceCategory    = ServiceCategory::findOrFail($id);

        $this->id           = $serviceCategory->id;
        $this->name         = $serviceCategory->name;
        $this->slug         = $serviceCategory->slug;
        $this->image        = $serviceCategory->image;
        $this->featured     = $serviceCategory->featured;
    }

    public function updateServiceCategory() 
    {
        $data = [
            'name'         => $this->name,
            'slug'         => $this->serviceHelpers->generateSlug($this->name),
            'image'        => $this->image,
            'featured'     => $this->featured,
        ];

        $this->validator->validate($data);

        \Log::info('setting service id to (UPDATE)' . $this->id);

        try {
            $serviceCategory    = ServiceCategory::findOrFail($this->id);

            $serviceCategory->name      = $this->name;
            $serviceCategory->slug      = $this->slug;
            $serviceCategory->image     = $this->image;
            $serviceCategory->featured  = $this->featured;

            if ($this->newImage) {
                $imageName              = $this->imageServices->changeCategoryImage($serviceCategory, $this->newImage);
                $serviceCategory->image = $imageName;
            }

            $this->serviceCategoryRepository->updateServiceCategory($serviceCategory, $serviceCategory->toArray());
            
            Session::flash('message', 'Category has been updated successfully');
        } catch(\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while updating the Category.');
        }
    }

    public function generateSlug(): void
    {       
        $this->slug = $this->serviceHelpers->generateSlug($this->name);
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layout.base');
    }
}
