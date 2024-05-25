<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditServiceComponent extends Component
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

    public $newImage;
    public $thumbnail;
    public $newThumbnail;
    public $description;
    public $inclusion;
    public $exclusion;

    public function mount($service_category_id) {
        $service = Service::find($service_category_id);

        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->tagline = $service->tagline;
        $this->service_category_id = $service->service_category_id;
        $this->price = $service->price;
        $this->discount = $service->discount;
        $this->discount_type = $service->discount_type;
        $this->image = $service->image;
        $this->thumbnail = $service->thumbnail;
        $this->description = $service->description;
        $this->inclusion = $service->inclusion;
        $this->exclusion = $service->exclusion;
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
            // 'image' => 'required',
            // 'thumbnail' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required'
        ]);
        if($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpg,png,jpeg'
            ]);
        }
        if($this->newThumbnail) {
            $this->validateOnly($fields,[
                'newThumbnail' => 'required|mimes:jpg,png,jpeg'
            ]);
        }
    }

    public function updateService() {
        $this->validate([ 
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
            // 'image' => 'required',
            // 'thumbnail' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required'
        ]);
        if($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
        if($this->newThumbnail) {
            $this->validate([
                'newThumbnail' => 'required|mimes:jpeg,png'
             ]);
        }
        $service = Service::find($this->service_category_id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->description = $this->description;
        $service->inclusion = $this->inclusion;
        $service->exclusion = $this->exclusion;
        if($this->newImage) {
            $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
            $this->newImage->storeAs('services', $imageName);
            $service->image = $imageName;
        }
        if($this->newThumbnail) {
            $thumbnailName = Carbon::now()->timestamp . "." . $this->newThumbnail->extension();
            $this->newThumbnail->storeAs('services', $thumbnailName);
            $service->thumbnail = $thumbnailName;
        }
        $service->save();
        session()->flash('message', 'Category has beed updated successfully');
    }
    public function render()
    {
        $service = Service::all();
        return view('livewire.admin.admin-edit-service-component', ['service' => $service])->layout('layout.base');
    }
}
