<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;

    protected $table = 'Classrooms';
    public $timestamps = true;

    protected $fillable=[
        'Name_Class',
        'Grade_id'
    ];

    public $translatable = ['Name_Class'];

    // علاقة لجلب المراحلة المتعلقة بكل قسم
    public function Grades()
    {
      return $this->belongsTo(Grade::class, 'Grade_id');
    }
}
