<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $table='attendences';
    public $timestamps=true;
    protected $fillable=[
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'teacher_id',
        'attendence_date',
        'attendence_status',
    ];

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
