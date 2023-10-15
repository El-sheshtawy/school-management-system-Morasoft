<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Exam extends Model
{
    use HasFactory, HasTranslations;

    protected $table='exams';
    protected $fillable = [
        'name',
        'term',
        'academic_year'
    ];
    public $translatable = ['name'];
    public $timestamps=true;
}
