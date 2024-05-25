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
        $scategory = Service::find($service_category_id);

        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->tagline = $scategory->tagline;
        $this->service_category_id = $scategory->service_category_id;
        $this->price = $scategory->price;
        $this->discount = $scategory->discount;
        $this->discount_type = $scategory->discount_type;
        $this->image = $scategory->image;
        $this->thumbnail = $scategory->thumbnail;
        $this->description = $scategory->description;
        $this->inclusion = $scategory->inclusion;
        $this->exclusion = $scategory->exclusion;
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
        $scategory = Service::find($this->service_categoru_id);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        $scategory->tagline = $this->tagline;
        $scategory->price = $this->price;
        $scategory->discount = $this->discount;
        $scategory->discount_type = $this->discount_type;
        $scategory->description = $this->description;
        $scategory->inclusion = $this->inclusion;
        $scategory->exclusion = $this->exclusion;
        if($this->newImage) {
            $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
            $this->newImage->storeAs('services', $imageName);
            $scategory->image = $imageName;
        }
        if($this->newThumbnail) {
            $thumbnailName = Carbon::now()->timestamp . "." . $this->newThumbnail->extension();
            $this->newThumbnail->storeAs('services', $thumbnailName);
            $scategory->thumbnail = $thumbnailName;
        }
        $scategory->save();
        session()->flash('message', 'Category has beed updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-service-component')->layout('layout.base');
    }
}
