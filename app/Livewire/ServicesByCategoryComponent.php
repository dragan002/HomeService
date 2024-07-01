<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ServicesByCategoryComponent extends Component
{
    public $categorySlug;

    public function mount($categorySlug) {
        $this->categorySlug = $categorySlug;
    }
    public function render()
    {
        $scategory = ServiceCategory::where('slug', $this->categorySlug)->first();
        return view('livewire.services-by-category-component',['scategory'=>$scategory])->layout('layout.base');
    }
}
