<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'headline',
        'short_bio',
        'long_bio',
        'location',
        'email',
        'avatar',
        'resume',
        'availability',
        'hero_label',
        'hero_description',
    ];
}
