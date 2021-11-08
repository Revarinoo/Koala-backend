<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'product_name',
        'rules',
        'campaign_logo',
        'business_id',
    ];

    public function business() {
        return $this->belongsTo('App\Models\Business');
    }

    public function contentPhoto() {
        return $this->hasMany('App\Models\ContentPhoto');
    }

    public function order() {
        return $this->hasMany('App\Models\Order');
    }

    public function contentDetail() {
        return $this->hasMany('App\Models\ContentDetail');
    }
}
