<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ServiceRepositoryInterface;

class ServiceController extends Controller {

    protected $serviceRepository;

    public function __consturct(ServiceRepositoryInterface $serviceRepository) {
        $this->serviceRepository = $serviceRepository;
    }

    public function index() {
        $services = $this->serviceRepository->all();
        return view('admin.allServices', compact('services'))
    }

    public function show($id) {
        $service = $this->serviceRepository->find($id);
        return view('admin.services_show', compact('services'))
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
            'tagline'=> 'required',
            'service_category_id'=> 'required',
            'price'=> 'required',
            'discount'=> 'required',
            'discount_type'=> 'required',
            'image'=> 'required|mimes:png,jpg',
            'thumbnail'=> 'required|mimes:png,jpg',
            'description'=> 'required',
            'inclusion'=> 'required',
            'exclusion'=> 'required',
        ]);

        $this->serviceRepository->create($data);
        return redirect()->route('admin.allServices')->with('message', 'Service Created Successfully');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
            'tagline'=> 'required',
            'service_category_id'=> 'required',
            'price'=> 'required',
            'discount'=> 'required',
            'discount_type'=> 'required',
            'image'=> 'required|mimes:png,jpg',
            'thumbnail'=> 'required|mimes:png,jpg',
            'description'=> 'required',
            'inclusion'=> 'required',
            'exclusion'=> 'required',
        ]);

        $this->serviceRepository->update($id, $data);
        return redirect()->route('admin.allServices')->with('message', 'Service Updated Successfully');

    }
}

