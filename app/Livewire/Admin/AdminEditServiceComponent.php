<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceCategory;
use App\Processor\Services\ServiceProcessor;
use App\Repositories\Service\ServiceRepository;
use Livewire\WithFileUploads;

class AdminEditServiceComponent extends Component
{
    use WithFileUploads;

    public $id;
    public $name;
    public $slug;
    public $tagline;
    public $serviceCategoryId;
    public $price;
    public $discount;
    public $discount_type;
    public $image;
    public $newImage;
    public $thumbnail;
    public $newThumbnail;
    public $description;
    public $inclusion;
    public $exclusion;
    public $featured;
    public $service_status;

    protected $serviceProcessor;
    protected $serviceRepository;

    public function mount($id)
    {
        $this->serviceProcessor = new ServiceProcessor;
        $this->serviceRepository = new ServiceRepository;

        $service = Service::find($id);

        if (!$service) {
            abort(404); // Handle case where service is not found
        }

        $this->id = $service->id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->tagline = $service->tagline;
        $this->serviceCategoryId = $service->service_category_id;
        $this->price = $service->price;
        $this->discount = $service->discount;
        $this->discount_type = $service->discount_type;
        $this->featured = $service->featured;
        $this->service_status = $service->service_status;
        $this->image = $service->image;
        $this->thumbnail = $service->thumbnail;
        $this->description = $service->description;
        $this->inclusion = str_replace('|', '\n', $service->inclusion);
        $this->exclusion = str_replace('|', '\n', $service->exclusion);
    }

    public function generateSlug(): void
    {
        $this->slug = $this->serviceProcessor->generateSlug($this->name);
    }

    public function updateService()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'price' => 'required',
            'description' => 'required',
            'featured' => 'nullable|boolean',
            'inclusion' => 'required',
            'exclusion' => 'required',
            'newImage' => 'nullable|mimes:jpeg,png,jpg', // Updated image validation
            'newThumbnail' => 'nullable|mimes:jpeg,png,jpg', // Updated thumbnail validation
        ]);

        try {
            $service = Service::find($this->id);

            if (!$service) {
                abort(404); // Handle case where service is not found
            }

            // Update service data
            $service->name = $this->name;
            $service->slug = $this->slug;
            $service->tagline = $this->tagline;
            $service->price = $this->price;
            $service->discount = $this->discount;
            $service->discount_type = $this->discount_type;
            $service->featured = $this->featured;
            $service->service_category_id = $this->serviceCategoryId;
            $service->service_status = $this->service_status;
            $service->description = $this->description;
            $service->inclusion = $this->inclusion;
            $service->exclusion = $this->exclusion;

            // Handle file uploads
            if ($this->newImage) {
                $imageName = $this->serviceProcessor->changeImage($this->newImage);
                $service->image = $imageName;
            }

            if ($this->newThumbnail) {
                $thumbnailName = $this->serviceProcessor->changeThumbnail($this->newThumbnail);
                $service->thumbnail = $thumbnailName;
            }

            // Save updated service
            \Log::info('Before updating service:', [$service]);
            $this->serviceRepository->updateService($service, $service->toArray());
            \Log::info("After updating service", [$service]);


            session()->flash('message', 'Service has been updated successfully');
        } catch(\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while updating the Service.');
        }
    }

    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-edit-service-component', ['categories' => $categories])->layout('layout.base');
    }
}
