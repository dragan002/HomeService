<?php

namespace App\Livewire\Sprovider;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

class AddSproviderServiceComponent extends Component
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

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updated($fields) {
        $this->validateOnly($fields, [
            'name'=> 'required',
            'slug'=> 'required',
            'tagline'=> 'required',
            'service_category_id'=> 'required',
            'price'=> 'required',
            'image'=> 'required|mimes:png,jpg',
            'thumbnail'=> 'required|mimes:png,jpg',
            'description'=> 'required',
            'inclusion'=> 'required',
            'exclusion'=> 'required',
        ]);
    }

    public function createService() {
        $this->validate([ 
            'name'=> 'required',
            'slug'=> 'required',
            'tagline'=> 'required',
            'service_category_id'=> 'required',
            'price'=> 'required',
            'image'=> 'required|mimes:png,jpg',
            'thumbnail'=> 'required|mimes:png,jpg',
            'description'=> 'required',
            'inclusion'=> 'required',
            'exclusion'=> 'required',
        ]);
    
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
        
        $imageName = Carbon::now()->timestamp . '.' . $this->thumbnail->getClientOriginalExtension();
        $this->thumbnail->storeAs('services/thumbnails', $imageName);
        $service->thumbnail = $imageName;
    
        $imageName2 = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
        $this->image->storeAs('services', $imageName2);
        $service->image = $imageName2;
    
        $service->user_id = Auth::id();
        
        $service->save();
        session()->flash('message', 'Service has been created!');
    }
    
    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.sprovider.add-sprovider-service-component',['categories'=>$categories])->layout('layout.base');
    }
}
