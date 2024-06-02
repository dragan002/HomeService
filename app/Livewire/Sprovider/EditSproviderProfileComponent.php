<?php

namespace App\Http\Livewire\Sprovider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class EditSproviderProfileComponent extends Component
{
    use WithFileUploads;
    public $service_provider_id;
    public $image;
    public $about;
    public $city;
    public $service_category_id;
    public $service_locations;
    public $newImage;

    public function mount() {
        $sprovider = ServiceProvider::where('user_id',Auth::user()->id)->first();
        $this->service_provider_id = $sprovider->id;
        $this->image = $sprovider->image;
        $this->about = $sprovider->about;
        $this->city = $sprovider->city;
        $this->service_category_id = $sprovider->service_category_id;
        $this->service_locations = $sprovider->service_locations;
    }

    public function updated($fields) {
        $this->validateOnly($fields, [
            'about' => 'required',
            'city' => 'required',
            'service_category_id' => 'required',
            'service_locations' => 'required',
        ]);
        if($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpeg,jpg,png|max:1024',
            ]);
        }
    }

    public function updateProfile() {
        $this->validate([
            'about' => 'required',
            'city' => 'required',
            'service_category_id' => 'required',
            'service_locations' => 'required',
        ]);
        if($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpeg,jpg,png|max:1024',
            ]);
        }
        
        $sprovider = ServiceProvider::where('user_id',Auth::user()->id)->first();
        $sprovider->about = $this->about;
        $sprovider->city = $this->city;
        $sprovider->service_category_id = $this->service_category_id;
        $sprovider->service_locations = $this->service_locations;
        
        if($this->newImage) {
            // if ($sprovider->image) {
            //     unlink(storage_path('app/public/sproviders/' . $sprovider->image));
            // }

            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('public/sproviders', $imageName);
            $sprovider->image = $imageName;          
        }

        $sprovider->save();
        session()->flash('message', 'Profile has been updated');
    }

    public function render()
    {
        $scategories = ServiceCategory::all();
        return view('livewire.sprovider.edit-sprovider-profile-component', ['scategories' => $scategories])->layout('layout.base');
    }
}
