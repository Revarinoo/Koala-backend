<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'order_id',
        'content_detail_id',
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function contentDetail(){
        return $this->belongsTo('App\Models\ContentDetail');
    }

    public function reporting() {
        return $this->hasOne('App\Models\Reporting');
    }
}
