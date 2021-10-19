<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'influencer_id',
        'photo',
    ];
}
