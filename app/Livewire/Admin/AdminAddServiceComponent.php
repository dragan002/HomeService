<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Helpers\ServiceHelpers;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Log;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Auth;
use App\Services\Service\ImageServices;
use Illuminate\Support\Facades\Session;
use App\Repositories\Service\ServiceRepository;


class AdminAddServiceComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $tagline;
    public $service_category_id;
    public $price;
    public $discount;
    public $discount_type;
    public $image;
    public $thumbnail;
    public $description;
    public $inclusion;
    public $exclusion;

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

    public function createService(): void 
    {
        $data = [
            'name'                  => $this->name,
            'slug'                  => $this->serviceHelpers->generateSlug($this->name),
            'tagline'               => $this->tagline,
            'service_category_id'   => $this->service_category_id,
            'price'                 => $this->price,
            'discount'              => $this->discount,
            'discount_type'         => $this->discount_type,
            'description'           => $this->description,
            'image'                 => $this->image,
            'thumbnail'             => $this->thumbnail,
            'inclusion'             => str_replace('\n', '|', trim($this->inclusion)),
            'exclusion'             => str_replace('\n', '|', trim($this->exclusion)),
            'user_id'               => Auth::id(),
        ];

        $this->validator->validate($data);

        try {
            $service = $this->serviceRepository->createService($data);

            $imageName = $this->imageServices->uploadImage($this->image, 'image');
            $thumbnailName = $this->imageServices->uploadImage($this->thumbnail, 'thumbnail');

            $this->serviceRepository->saveService($service, $imageName, $thumbnailName);
            
            Session::flash('message', 'Service has been created successfully');
        } catch(\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while creating the Service.');
        }
    }

    public function generateSlug(): void
    {
        $this->slug = $this->serviceHelpers->generateSlug($this->name);
    }

    public function render() 
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-add-service-component', [
            'categories' => $categories
            ])
            ->layout('layout.base');
    }
}
