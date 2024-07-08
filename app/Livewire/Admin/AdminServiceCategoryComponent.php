<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Session;
use App\Repositories\ServiceCategories\ServiceCategoryRepository;

class AdminServiceCategoryComponent extends Component
{
    use WithPagination;

    protected $serviceCategoryRepository;

    public function __construct()
    {
        $this->serviceCategoryRepository = new ServiceCategoryRepository();
    }

    public function deleteServiceCategory($id)
    {
        if(!$this->serviceCategoryRepository->deleteServiceCategoryById($id)) {
            Session::flash('error', 'Something went wrong');
        }
        
        $this->serviceCategoryRepository->deleteServiceCategoryById($id);
            Session::flash('message', 'Service Category deleted successfully');
    }

    public function render()
    {
        $scategories = $this->serviceCategoryRepository->paginateServiceCategory();
        return view('livewire.admin.admin-service-category-component',['scategories'=>$scategories])->layout('layout.base');
    }
}
