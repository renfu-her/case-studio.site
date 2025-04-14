<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'meta_title',
        'meta_description',
        'meta_image'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];
}
