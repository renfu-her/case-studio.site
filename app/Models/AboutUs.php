<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_image'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
