<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ServicesByCategoryComponent extends Component
{
    public $category_slug;

    public function mount($category_slug) {
        $this->category_slug = $category_slug;
    }
    public function render()
    {
        $scategory = ServiceCategory::where('slug', $this->category_slug)->first();
        return view('livewire.services-by-category-component',['scategory'=>$scategory])->layout('layout.base');
    }
}
