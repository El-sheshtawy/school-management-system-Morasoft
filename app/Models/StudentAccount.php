<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;
    protected $table='student_accounts';
    public $timestamps=true;
    protected $fillable=[
        'Debit',
        'credit',
        'student_id',
        'Grade_id',
        'Classroom_id',
        'description',
    ];
}
