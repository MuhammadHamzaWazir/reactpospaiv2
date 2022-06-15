<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'user_id',
        'meta_title',
        'meta_description',
        'meta_tag',
        'title',
        'short_description',
        'description',
        'status',
    ];
}
