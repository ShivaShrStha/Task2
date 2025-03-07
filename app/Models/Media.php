<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_type',
        'media_paths',
    ];

    protected $casts = [
        'media_paths' => 'array',
    ];
}
