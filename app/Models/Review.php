<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'comment',
        'rating'
    ];

    public function service() {
        return $this->belongsTo(Service::class)
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
