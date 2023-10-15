<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasFactory,HasTranslations;

    protected $table='teachers';
    public $timestamps=true;
    protected $fillable = [
        'name',
        'email',
        'password',
        'Address',
        'Joining_Date',
        'Specialization_id',
        'Gender_id',
    ];
    public $translatable = [
        'name'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class,'Gender_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class,'Specialization_id');
    }

    public function Sections()
    {
        return $this->belongsToMany(Section::class,'teacher_section');
    }
}
