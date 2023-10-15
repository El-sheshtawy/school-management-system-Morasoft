<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory,HasTranslations;
    public $translatable=['title'];
    protected $table='fees';
    public $timestamps=true;
    protected $fillable=[
        'title',
        'amount',
        'Grade_id',
        'Classroom_id',
        'year',
        'description',
        'Fee_type',
        ];

    public function grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'Classroom_id');
    }


}
