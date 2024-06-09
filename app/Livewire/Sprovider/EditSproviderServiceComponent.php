<?php
namespace App\Livewire\Sprovider;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceCategory;

class EditSproviderServiceComponent extends Component
{
    use WithFileUploads;

    public $service_id;
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
    public $newImage;
    public $newThumbnail;

    public function mount($service_id) {
        $service = Service::where('id', $service_id)->where('user_id', Auth::id())->first();
        if (!$service) {
            abort(403, 'Unauthorized Action');
        }
        $this->service_id = $service->id;
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
        $this->inclusion = str_replace('|', '\n', $service->inclusion);
        $this->exclusion = str_replace('|', '\n' ,$service->exclusion);
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'service_category_id' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discount_type' => 'nullable|string|max:255',
            'description' => 'required|string',
            'inclusion' => 'required|string',
            'exclusion' => 'required|string',            
        ]);
        if($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpg,jpeg,png',
            ]);
        }
        if($this->newThumbnail) {
            $this->validateOnly($fields, [
                'newThumbnail' => 'required|mimes:jpg,png,jpeg',
            ]);
        }
    }

    public function updateServiceProvider() {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'service_category_id' => 'required|integer|exists:service_categories,id',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discount_type' => 'nullable|string|max:255',
            'description' => 'required|string',
            'inclusion' => 'required|string',
            'exclusion' => 'required|string',
        ]);
        if($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpg,jpeg,png',
            ]);
        }
        if($this->newThumbnail) {
            $this->validate([
                'newThumbnail' => 'required|mimes:jpg,png,jpeg',
            ]);
        }

        $service = Service::find($this->service_id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->description = $this->description;
        $service->inclusion = str_replace('\n', '|', $this->inclusion);  // Ensure inclusions are correctly formatted for saving
        $service->exclusion = str_replace('\n', '|', $this->exclusion);  // Ensure exclusions are correctly formatted for saving

        if ($this->newImage) {
            // Remove old image if it exists
            if(file_exists('images/services/' . $this->image)) {
                unlink(('images/services/' . $this->image));
            }
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('services/', $imageName);
            $service->image = $imageName;
        }

        if ($this->newThumbnail) {
            // Remove old thumbnail if it exists
            if(file_exists('images/services/thumbnails' . '/' . $this->thumbnail)) {
                unlink('images/services/thumbnails' . '/' . $this->thumbnail);
            }
            $thumbnailName = Carbon::now()->timestamp . '.' . $this->newThumbnail->extension();
            $this->newThumbnail->storeAs('services/thumbnails', $thumbnailName);
            $service->thumbnail = $thumbnailName;
        }

        $service->save();

        session()->flash('message', 'Service has been updated successfully');
    }

    public function render() {
        $categories = ServiceCategory::all();
        $service = Service::all();
        return view('livewire.sprovider.edit-sprovider-service-component', ['categories' => $categories, 
        'service'=>$service])->layout('layout.base');
    }
}
