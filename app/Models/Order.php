<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'order_date',
        'influencer_id',
        'content_id',
    ];

    public function content() {
        return $this->belongsTo('App\Models\Content');
    }

    public function orderDetail() {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
