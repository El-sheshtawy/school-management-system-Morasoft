<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = [
        'Name_Section',
        'Status',
        'Grade_id',
        'Class_id',
    ];

    public $translatable = [
        'Name_Section'
    ];

    public function My_classs()
    {
        return $this->belongsTo(Classroom::class, 'Class_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }

    public function Grades()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }
}
