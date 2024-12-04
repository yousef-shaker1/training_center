<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'img',
        'name',
        'description',
        'price',
        'Numberofhours',
        'Quantity',
        'type',
        'start_data',
        'end_data'
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
