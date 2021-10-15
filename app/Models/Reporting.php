<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_url',
        'views',
        'likes',
        'comments',
        'impressions',
        'reach',
    ];
}
