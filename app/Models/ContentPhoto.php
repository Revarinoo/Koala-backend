<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'photo',
    ];

    public function content() {
        return $this->belongsTo('App\Models\Content');
    }
}
