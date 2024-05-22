<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;

class AdminEditServiceCategoryComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newImage;

    public function mouth($category_id) {
        $scategory = ServiceCategory::find($category_id);
        $this->category_id = $scategory->id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layout.base');
    }
}
