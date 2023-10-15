<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasFactory,HasTranslations;
    protected $table='genders';
    protected $fillable = [
        'id',
        'Name',
        'created_at',
        'updated_at',
    ];
    protected $translatable=['Name'];
    public $timestamps=true;
}
