<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'content_type',
        'instruction'
    ];

    public function orderDetail() {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function Content(){
        return $this->belongsTo('App\Models\Content');
    }
}
