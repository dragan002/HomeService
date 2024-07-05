<?php

namespace App\Validators;

use App\Validators\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class ServiceValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg',
            'thumbnail' => 'required|mimes:png,jpg',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
        ]);
        return $validator->passes();
    }
}
