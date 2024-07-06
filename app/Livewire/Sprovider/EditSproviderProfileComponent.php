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

    public function __construct()
    {
        $this->providerProfileRepository = new ProviderProfileRepository;
        $this->validator = new ServiceProviderValidator;
    }

    public function mount($id) {
        \Log::info('Mounting EditSproviderProfileComponent with ID: ' . $id);
        \Log::debug('Received ID: ' . $id);

        $serviceProvider = ServiceProvider::where('user_id', Auth::user()->id)->first();

        if (!isset($id)) {
            \Log::error('No ID parameter passed to mount method');
        }

        $this->id                   = $serviceProvider->id;
        $this->image                = $serviceProvider->image;
        $this->about                = $serviceProvider->about;
        $this->city                 = $serviceProvider->city;
        $this->serviceCategoryId    = $serviceProvider->service_category_id;
        $this->serviceLocations     = $serviceProvider->service_locations;
    }

    public function updateProfile()
    {
        $data = [
            'image'                => $this->image,
            'about'                => $this->about,
            'city'                 => $this->city,
            'service_category_id'  => $this->serviceCategoryId,
            'service_locations'    => $this->serviceLocations,
        ];
        
        $this->validator->validate($data);

        try {
            $serviceProvider = ServiceProvider::where('user_id',Auth::user()->id)->first();

            $serviceProvider->about = $this->about;
            $serviceProvider->city = $this->city;
            $serviceProvider->service_category_id = $this->serviceCategoryId;
            $serviceProvider->service_locations = $this->serviceLocations;

            if ($this->newImage) {
                $imageName = $this->providerProfileRepository->changeProviderProfile($serviceProvider, $this->newImage);
                $serviceProvider->image = $imageName;
            }
            
            $this->providerProfileRepository->updateProfile($serviceProvider, $service->toArray());
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
