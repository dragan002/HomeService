<?php

namespace App\Models;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";

    protected $fillable = [
        'name',
        'slug',
        'price',
        'discount',
        'service_status',
        'user_id', 
    ];


    public function category() {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    public function averageRating() {
        return $this->reviews()->avg('rating');
    }
    public function bookings() {
        return $this->hasMany(User::class);
    }
}
