<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminSliderComponent extends Component
{
    use WithPagination;

    public function deleteSlide($id) {
        try {
            $slide = Slider::findOrFail($id); // Use findOrFail to handle non-existent records

            if (Storage::disk('public')->exists('images/slider/' . $slide->image)) {
                Storage::disk('public')->delete('images/slider/' . $slide->image); // Use Storage facade for file operations
            }

            $slide->delete();

            session()->flash('message', 'Slide has been deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting slide: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while deleting the slide.');
        }
    }

    public function render() {
        $slides = Slider::paginate(10);
        return view('livewire.admin.admin-slider-component', ['slides' => $slides])->layout('layout.base');
    }
}
