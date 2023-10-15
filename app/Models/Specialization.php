<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    use HasFactory,HasTranslations;
    protected $table ='specializations';
    public $timestamps= true;
    protected $fillable = [
        'id',
        'Name',
        'created_at',
        "updated_at"
    ];
    public $translatable = ['Name'];

}
