<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ServiceHelpers
{
    public function generateSlug(string $name): string
    {
        return Str::slug($name, '-');
    }
}