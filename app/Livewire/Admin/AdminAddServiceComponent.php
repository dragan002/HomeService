<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;

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

    public function generateSlug(): void
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function validateInput(): void 
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg',
            'thumbnail' => 'required|mimes:png,jpg',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
        ]);
    }
    
    private function createServiceInstance(): Service
    {
        $service = new Service();
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->description = $this->description;
        $service->inclusion = str_replace('\n', '|', trim($this->inclusion));
        $service->exclusion = str_replace('\n', '|', trim($this->exclusion));
        return $service;
    }

    private function uploadImage(string $field): string 
    {
        $imageName = Carbon::now()->timestamp . '.' . $this->{$field}->getClientOriginalExtension();
        $this->{$field}->storeAs('services/' . ($field === 'thumbnail' ? 'thumbnails' : 'images'), $imageName);
        return $imageName;
    }

    private function saveService(Service $service, string $imageName, string $thumbnailName): void 
    {
        $service->image = $imageName;
        $service->thumbnail = $thumbnailName;
        $service->save();
    }

    public function createService(): void 
    {
        $this->validateInput();

        try {
            $service = $this->createServiceInstance();
            $imageName = $this->uploadImage('image');
            $thumbnailName = $this->uploadImage('thumbnail');

            $this->saveService($service, $imageName, $thumbnailName);

            session()->flash('message', 'Service has been created successfully');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            session()->flash('error', 'An error occurred while creating the Service. Please check AdminAddServiceComponent');
        }
    }

    public function render() 
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-add-service-component', ['categories' => $categories])
            ->layout('layout.base');
    }
}
