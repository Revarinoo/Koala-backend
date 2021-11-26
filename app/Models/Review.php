<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
        'order_id',
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
