<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $table='personal_infos';
    public $timestamps=true;
    protected $fillable=[
        'key',
        'value',
    ];
}
