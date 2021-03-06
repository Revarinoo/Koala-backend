<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type',
        'min_rate',
        'max_rate',
        'influencer_id',
        'platform_id',
    ];

    public function influencer(){
        return $this->belongsTo('App\Models\Influencer');
    }

    public function platform() {
        return $this->belongsTo('App\Models\Platform');
    }
}
