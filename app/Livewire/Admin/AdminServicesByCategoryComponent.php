<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use App\Models\ServiceCategory;
use Livewire\WithPagination;

class AdminServicesByCategoryComponent extends Component
{
    use WithPagination;
    public $categorySlug;

    public function mount($categorySlug) {
        $this->categorySlug = $categorySlug;
    }
    public function render()
    {
        $category= ServiceCategory::where('slug', $this->categorySlug)->first();
        $services = Service::where('service_category_id', $category->id)->paginate(10);
        return view('livewire.admin.admin-services-by-category-component',['category_name' => $category->name, 'services' => $services])->layout('layout.base');
    }
}
