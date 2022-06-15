<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_tag',
        'status',
    ];
}
