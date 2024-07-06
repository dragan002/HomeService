<?php

namespace App\Validators;

use App\Validators\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class ServiceProviderValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            'about' => 'required',
            'city' => 'required',
            'service_category_id' => 'required',
            'service_locations' => 'required',
            'newImage' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);
        return $validator->passes();
    }
}