<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use App\Repositories\Service\ServiceRepository;

class AdminServicesComponent extends Component
{
    use WithPagination;

    protected $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository;
    }

    public function deleteService($id)
    {
        if(!$this->serviceRepository->deleteServiceById($id))
        {
            Session::flash('error', 'Something went wrong');
        }
        
        $this->serviceRepository->deleteServiceById($id);
            Session::flash('message', 'Service deleted successfully');
    }

    public function render()
    {
        $services = $this->serviceRepository->paginateService();
        return view('livewire.admin.admin-services-component',['services'=> $services])->layout('layout.base');
    }
}
