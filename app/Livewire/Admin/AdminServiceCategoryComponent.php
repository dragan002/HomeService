<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceCategory;
use Livewire\WithPagination;

class AdminServiceCategoryComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $scategories = ServiceCategory::paginate(10);
        return view('livewire.admin.admin-service-category-component',['scategories'=>$scategories])->layout('layout.base');
    }
}
