<?php

namespace App\Livewire\Sprovider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Validators\ServiceProviderValidator;
use App\Repositories\ServiceProviderProfile\ProviderProfileRepository;

class EditSproviderProfileComponent extends Component
{
    use WithFileUploads;

    public $id;
    public $image;
    public $about;
    public $city;
    public $serviceCategoryId;
    public $serviceLocations;
    public $newImage;

    protected $providerProfileRepository;
    protected $validator;

    public function mount($id, ProviderProfileRepository $providerProfileRepository, ServiceProviderValidator $validator) {
        
        $this->providerProfileRepository = $providerProfileRepository;
        $this->validator = $validator;

        $serviceProvider = ServiceProvider::where('user_id', Auth::user()->id)->first();

        $this->id                   = $serviceProvider->id;
        $this->image                = $serviceProvider->image;
        $this->about                = $serviceProvider->about;
        $this->city                 = $serviceProvider->city;
        $this->serviceCategoryId    = $serviceProvider->service_category_id;
        $this->serviceLocations     = $serviceProvider->service_locations;
    }

    public function updateProfile(ProviderProfileRepository $providerProfileRepository, ServiceProviderValidator $validator)
    {
        $this->providerProfileRepository = $providerProfileRepository;
        $this->validator = $validator;

        \Log::info("updating profile for user ID" . Auth::user()->id);

        $data = [
            'image'                => $this->image,
            'about'                => $this->about,
            'city'                 => $this->city,
            'service_category_id'  => $this->serviceCategoryId,
            'service_locations'    => $this->serviceLocations,
        ];

        \Log::info('data to be validated' , $data);
        
        $this->validator->validate($data);

        try {
            $serviceProvider = ServiceProvider::where('user_id',Auth::user()->id)->first();

            \Log::info('Service provider found', $serviceProvider->toArray());

            $serviceProvider->about                 = $this->about;
            $serviceProvider->city                  = $this->city;
            $serviceProvider->service_category_id   = $this->serviceCategoryId;
            $serviceProvider->service_locations     = $this->serviceLocations;

            if ($this->newImage) {
                \Log::info('New image uploaded.');
                $imageName = $this->providerProfileRepository->changeProviderImage($serviceProvider, $this->newImage);
                $serviceProvider->image = $imageName;
            }

            $this->providerProfileRepository->updateProviderProfile($serviceProvider, $serviceProvider->toArray());

            Session::flash('message', 'Service has been updated successfully');
        } catch(\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while updating the Service.');
        }
    }

    public function render()
    {
        \Log::info('Rendering EditSproviderProfileComponent');

        $scategories = ServiceCategory::all();
        return view('livewire.sprovider.edit-sprovider-profile-component', [
            'scategories' => $scategories,
            
            ])->layout('layout.base');
    }
}
