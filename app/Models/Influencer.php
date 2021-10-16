<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'contact_email',
        'engagement_rate',
        'user_id',
    ];

    public function platform(){
        return $this->hasMany('App\Models\Platform');
    }

    public function product() {
        return $this->hasMany('App\Models\Product');
    }
}
