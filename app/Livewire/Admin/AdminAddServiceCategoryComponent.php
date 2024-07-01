<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;


class AdminAddServiceCategoryComponent extends Component
{
    use WithFileUploads; 
    public $name;
    public $slug;
    public $image;

    public function generateSlug(): void {
        $this->slug = Str::slug($this->name, '-');
    }

   public function createNewCategory() {
    $this->validate([
        'name' => 'required',
        'slug' => 'required',
        'image' => 'required|mimes:jpeg,png'
    ]);

    try {
        $serviceCategory = $this->createServiceCategory();
        $imageName = $this->uploadImage();
        $this->saveCategory($serviceCategory, $imageName);
        session()->flash('message', 'Category has been created successfully');
    } catch (\Exception $e){
        \Log::error($e->getMessage());
        session()->flash('error', 'An error occurred while creating the category. Please check AdminAddServiceCategoryComponent');
    }
   }

   private function createServiceCategory() {
    
    $serviceCategory = new ServiceCategory();
    $serviceCategory->name = $this->name;
    $serviceCategory->slug = $this->slug;
    return $serviceCategory;
   }

   public function uploadImage() {
    $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
    $this->image->storeAs('categories', $imageName);
    return $imageName;
   }

   public function saveCategory(ServiceCategory $serviceCategory, string $imageName) {
    $serviceCategory->image = $imageName;
    $serviceCategory->save();
   }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layout.base');
    }
}
