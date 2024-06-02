<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function category() {
        return $this->BelongsTo(ServiceCategory::class, 'service_category_id');
    }
}
