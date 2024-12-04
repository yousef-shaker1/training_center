<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = ['img', 'name', 'description', 'year_experience', 'section_id'];

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
