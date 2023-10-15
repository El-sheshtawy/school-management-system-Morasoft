<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Authenticatable
{
    use HasFactory, HasTranslations;

    protected $table = 'my__parents';
    public $timestamps = true;
    protected $fillable = [
     'email',
     'password',

    //Father Information
     'Name_Father',
     'Name_Father_en',
     'National_ID_Father',
     'Passport_ID_Father',
     'Phone_Father',
     'Job_Father',
     'Job_Father_en',
     'Nationality_Father_id',
     'Blood_Type_Father_id',
     'Address_Father',
     'Religion_Father_id',

    //Mother Information
     'Name_Mother',
     'Name_Mother_en',
     'National_ID_Mother',
     'Passport_ID_Mother',
     'Phone_Mother',
     'Job_Mother',
     'Job_Mother_en',
     'Nationality_Mother_id',
     'Blood_Type_Mother_id',
     'Address_Mother',
     'Religion_Mother_id',
    ];

    public $translatable = [
        'Name_Father',
        'Job_Father',
        'Name_Mother',
        'Job_Mother',
    ];
}

