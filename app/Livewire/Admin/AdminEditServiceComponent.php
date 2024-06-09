<?php
namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;

class AdminEditServiceComponent extends Component
{
    use WithFileUploads;
    public $id;
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

    public $featured;
    public $service_status;

    public function mount($id) {
        $service = Service::find($id);
        $this->id = $service->id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->tagline = $service->tagline;
        $this->service_category_id = $service->service_category_id;
        $this->price = $service->price;
        $this->discount = $service->discount;
        $this->discount_type = $service->discount_type;
        $this->featured = 0;
        $this->service_status = $service->service_status; 
        $this->image = $service->image;
        $this->thumbnail = $service->thumbnail;
        $this->description = $service->description;
        $this->inclusion = str_replace('|', '\n', $service->inclusion);
        $this->exclusion = str_replace('|', '\n' ,$service->exclusion);
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'price' => 'required',
            'description' => 'required',
            'featured' => 'nullable|boolean',
            'inclusion' => 'required',
            'exclusion' => 'required',
            'service_status' => 'nullable'
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
            'service_category_id'=> 'required',
            'price' => 'required',
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
        $service = Service::find($this->id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->featured = $this->featured;
        $service->service_status = $this->service_status;
        $service->description = $this->description;
        $service->inclusion = $this->inclusion;
        $service->exclusion = $this->exclusion;

        if($this->newImage) {
            if(file_exists('images/services' . '/' . $service->image)) {
                unlink('images/services' . '/' . $service->image);
            }
            $imageName = Carbon::now()->timestamp . "." . $this->newImage->extension();
            $this->newImage->storeAs('services/', $imageName);
            $service->image = $imageName;
        }
        if($this->newThumbnail) {
            if(file_exists('images/services/thumbnails' . '/' . $service->thumbnail)) {
                unlink('images/services/thumbnails' . '/' . $service->thumbnail);
            }
            $thumbnailName = Carbon::now()->timestamp . "." . $this->newThumbnail->extension();
            $this->newThumbnail->storeAs('services/thumbnails', $thumbnailName);
            $service->thumbnail = $thumbnailName;
        }
        $service->save();
        session()->flash('message', 'Service has been updated successfully');
    }

    public function render() {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-edit-service-component', ['categories' => $categories])->layout('layout.base');
    }
}
