<?php

namespace App\Models;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";

    public function category() {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
