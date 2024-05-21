<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;


class AdminAddServiceCategoryComponent extends Component
{
    public $name;
    public $slug;
    public $image;

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update() {
        $this->validateOnly([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg, png'
         ]);
    }

    public function createNewCategory() {
        $this->validate([ 
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg, png'
        ]);

        $scategory = new ServiceCategory();
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('categories', $imageName);
        $scategory->image = $imageName;
        $scategory->save();
        session()->flash('message', 'Category has been created successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layout.base');
    }
}
