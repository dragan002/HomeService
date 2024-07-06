<?php
namespace App\Livewire\Sprovider;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Helpers\ServiceHelpers;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Log;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Auth;
use App\Services\Service\ImageServices;
use Illuminate\Support\Facades\Session;
use App\Repositories\Service\ServiceRepository;


class EditSproviderServiceComponent extends Component
{
    use WithFileUploads;

    public $id;
    public $name;
    public $slug;
    public $tagline;
    public $serviceCategoryId;
    public $price;
    public $discount;
    public $discountType;
    public $image;
    public $thumbnail;
    public $description;
    public $inclusion;
    public $exclusion;
    public $newImage;
    public $newThumbnail;

    protected $serviceRepository;
    protected $imageService;
    protected $validator;
    protected $serviceHelpers;

    public function __construct() 
    {
        $this->serviceRepository = new ServiceRepository;
        $this->imageServices = new ImageServices;
        $this->validator = new ServiceValidator;
        $this->serviceHelpers = new ServiceHelpers;
    }

    public function mount($id) {
        $service = Service::findOrFail($id);

        $this->id                   = $service->id;
        $this->name                 = $service->name;
        $this->slug                 = $service->slug;
        $this->tagline              = $service->tagline;
        $this->serviceCategoryId    = $service->service_category_id;
        $this->price                = $service->price;
        $this->discount             = $service->discount;
        $this->discountType         = $service->discount_type;
        $this->image                = $service->image;
        $this->thumbnail            = $service->thumbnail;
        $this->description          = $service->description;
        $this->inclusion            = str_replace('|', '\n', $service->inclusion);
        $this->exclusion            = str_replace('|', '\n' ,$service->exclusion);
    }

    public function updateService() 
    {
        $data = [
            'name'                  => $this->name,
            'slug'                  => $this->serviceHelpers->generateSlug($this->name),
            'tagline'               => $this->tagline,
            'service_category_id'   => $this->serviceCategoryId,
            'price'                 => $this->price,
            'discount'              => $this->discount,
            'discount_type'         => $this->discountType,
            'description'           => $this->description,
            'image'                 => $this->image,
            'thumbnail'             => $this->thumbnail,
            'inclusion'             => str_replace('\n', '|', trim($this->inclusion)),
            'exclusion'             => str_replace('\n', '|', trim($this->exclusion)),
            'user_id'               => Auth::id(),
        ];

        $this->validator->validate($data);

        try {
            $service = Service::findOrFail($this->id);

            // Update service data
            $service->name                  = $this->name;
            $service->slug                  = $this->slug;
            $service->tagline               = $this->tagline;
            $service->price                 = $this->price;
            $service->discount              = $this->discount;
            $service->discount_type         = $this->discountType;
            $service->service_category_id   = $this->serviceCategoryId;
            $service->discount_type         = $this->discountType;
            $service->description           = $this->description;
            $service->inclusion             = $this->inclusion;
            $service->exclusion             = $this->exclusion;

            // Handle file uploads
            if ($this->newImage) {
                $imageName = $this->imageServices->changeImage($service, $this->newImage);
                $service->image = $imageName;
            }
    
            if ($this->newThumbnail) {
                $thumbnailName = $this->imageServices->changeThumbnail($service, $this->newThumbnail);
                $service->thumbnail = $thumbnailName;
            }

            // Save updated service
            $this->serviceRepository->updateService($service, $service->toArray());

            Session::flash('message', 'Service has been updated successfully');
        } catch(\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());
            Session::flash('error', 'An error occurred while updating the Service.');
        }
    }
    
    public function generateSlug(): void
    {       
        $this->slug = $this->serviceHelpers->generateSlug($this->name);
    }

    public function render() {
        $categories = ServiceCategory::all();
        $service = Service::all();
        return view('livewire.sprovider.edit-sprovider-service-component', [
        'categories'    => $categories, 
        'service'       => $service,
        ])->layout('layout.base');
    }
}
