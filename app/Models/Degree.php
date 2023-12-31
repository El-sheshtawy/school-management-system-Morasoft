<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Degree extends Model
{
    use HasFactory;
    protected $table='degrees';
    protected $fillable=[
        'student_id',
        'quizze_id',
        'question_id',
        'score',
        'date',
        'abuse',
    ];
    public $timestamps=true;

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function quizze()
    {
        return $this->belongsTo(Quizze::class,'quizze_id');
    }
}
