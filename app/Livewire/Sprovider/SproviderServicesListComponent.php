<?php

namespace App\Livewire\Sprovider;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceProvider;

class SproviderServicesListComponent extends Component
{
    use WithPagination;

    public function deleteServiceByProvider($service_id){
        $service = Service::find($service_id);
        if($service->image) {
            unlink('images/services' . '/' . $service->image);
        }
        $service->delete();
        session()->flash('message', 'Service deleted successfully');
    } 

    public function render()
    {
        $services = Service::where('user_id', auth()->id())->paginate(10);
        return view('livewire.sprovider.sprovider-services-list-component', ['services'=>$services])->layout('layout.base');
    }
}
