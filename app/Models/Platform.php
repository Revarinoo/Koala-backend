<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'socialmedia_id',
        'audience_age',
        'followers',
        'average_likes',
        'average_comments',
        'influencer_id',
    ];

    public function influencer(){
        return $this->belongsTo('App\Models\Influencer');
    }

    public function product() {
        return $this->hasMany('App\Models\Product');
    }
}
