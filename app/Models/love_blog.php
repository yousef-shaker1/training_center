<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class love_blog extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'user_id'];
}
