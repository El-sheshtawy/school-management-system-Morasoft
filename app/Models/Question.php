<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questions';
    public $timestamps=true;
    protected $fillable=[
        'title',
        'answers',
        'right_answer',
        'score',
        'quizze_id',
    ];
    public function quizze()
    {
        return $this->belongsTo(Quizze::class,'quizze_id');
    }
}
