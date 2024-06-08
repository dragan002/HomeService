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
        $this->inclusion = $service->inclusion;
        $this->exclusion = $service->exclusion;
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
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
            'newImage' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'newThumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $service = Service::find($this->service_id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->description = $this->description;
        $service->inclusion = $this->inclusion;
        $service->exclusion = $this->exclusion;

        if ($this->newImage) {
            if(file_exists('sproviders' . '/' . $image->name)) {
                unlink('sproviders' . '/' . $image->name);
            }
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('sproviders', $imageName);
            $service->image = $imageName;
        }

        if ($this->newThumbnail) {
            if(file_exists('sproviders/thumbnails' . '/' . $thumbnail->name)) {
                unlink('sproviders/thumbnails' . '/' . $thumbnail->name);
            }
            $thumbnailName = Carbon::now()->timestamp . '.' . $this->newThumbnail->extension();
            $this->newThumbnail->storeAs('sproviders/thumbnails', $thumbnailName);
            $service->thumbnail = $thumbnailName;
        }

        $service->save();

        session()->flash('message', 'Service has been updated successfully');
    }

    public function render() {
        $categories = ServiceCategory::all();
        return view('livewire.sprovider.edit-sprovider-service-component', ['categories' => $categories])->layout('layout.base');
    }
}
