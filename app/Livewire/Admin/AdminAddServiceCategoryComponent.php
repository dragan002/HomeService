<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Helpers\ServiceHelpers;
use App\Models\ServiceCategory;
use App\Services\ImageServices;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Session;
use App\Repositories\Service\ServiceRepository;

class AdminAddServiceCategoryComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;

    protected $serviceRepository;
    protected $serviceHelpers;
    protected $imageServices;
    protected $validator;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository;
        $this->serviceHelpers = new ServiceHelpers;
        $this->imageServices = new ImageServices;
        $this->validator = new ServiceValidator;
    }

    public function generateSlug(): void
    {
        $this->slug = $this->serviceHelpers->generateSlug($this->name);
    }
    
    public function createServiceCategory(): void
    {

        $data = [
            'name'  => $this->name,
            'slug'  => $this->slug,
            'image' => $this->image,
        ];
        
        $this->validator->validate($data);

        try {
            $category = $this->serviceRepository->createServiceCategory($data);
            $imageName = $this->imageServices->uploadImageCategory($this->image, 'categoryImage');
            $this->serviceRepository->saveServiceCategory($category, $this->name, $this->slug, $imageName);
            
            Session::flash('message', 'Category has been created successfully');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', 'An error occurred while creating the category. Please check AdminAddServiceCategoryComponent');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layout.base');
    }
}
