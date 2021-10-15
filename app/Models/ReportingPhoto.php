<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'photo',
    ];
}
