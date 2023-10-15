<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    protected $table = 'Grades';
    public $timestamps = true;

    protected $fillable=[
        'Name',
        'Notes'
    ];
    public $translatable = [
        'Name'
    ];

    // علاقة لجلب الاقسام المتعلقة بكل مرحلة
    public function Sections()
    {
        return $this->hasMany(Section::class, 'Grade_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'teacher_section');
    }
}
