<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'website',
        'instagram',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function content(){
        return $this->hasMany('App\Models\Content');
    }
}
