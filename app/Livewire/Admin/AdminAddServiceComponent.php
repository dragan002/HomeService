<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use App\Processor\Services\ServiceProcessor;
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

    protected $serviceProcessor;
    protected $serviceRepository;
    

    public function __construct() 
    {
        $this->serviceProcessor = new ServiceProcessor;
        $this->serviceRepository = new ServiceRepository;
    }

    public function createService(): void 
    {
        $data = [
            'name' => $this->name,
            'slug' => $this->serviceProcessor->generateSlug($this->name),
            'tagline' => $this->tagline,
            'service_category_id' => $this->service_category_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'description' => $this->description,
            'image' => $this->image,
            'thumbnail' => $this->thumbnail,
            'inclusion' => str_replace('\n', '|', trim($this->inclusion)),
            'exclusion' => str_replace('\n', '|', trim($this->exclusion)),
            'user_id' => Auth::id(),
        ];

        $this->serviceProcessor->validateData($data);

        try {
            $service = $this->serviceRepository->createService($data);

            $imageName = $this->serviceProcessor->uploadImage($this->image, 'image');
            $thumbnailName = $this->serviceProcessor->uploadImage($this->thumbnail, 'thumbnail');

            $this->serviceRepository->setServiceImagesNamesAndSave($service, $imageName, $thumbnailName);
            
            session()->flash('message', 'Service has been created successfully');
        } catch(\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while creating the Service.');
        }
    }
    public function generateSlug(): void
    {
        $this->slug = $this->serviceProcessor->generateSlug($this->name);
    }

    public function render() 
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-add-service-component', ['categories' => $categories])
            ->layout('layout.base');
    }
}
