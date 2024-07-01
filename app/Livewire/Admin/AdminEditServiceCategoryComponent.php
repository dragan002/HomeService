<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;

class AdminEditServiceCategoryComponent extends Component
{
    use WithFileUploads;
    public $categoryId;
    public $name;
    public $slug;
    public $image;
    public $featured;
    public $newImage;

    public function mount($categoryId) {
        $scategory = ServiceCategory::find($categoryId);
        $this->categoryId = $scategory->id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;
        $this->featured = $scategory->featured;
    }

    public function generateSlug() {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update($fields) {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'featured' => 'required'
        ]);

        if($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
    }
    public function updateServiceCategory() {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }

        $scategory = ServiceCategory::find($this->categoryId);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        $scategory->featured = $this->featured;
        if($this->newImage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('categories', $imageName);
            $scategory->image = $imageName;
        }
        $scategory->save();
        session()->flash('message', 'Category has been updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layout.base');
    }
}
