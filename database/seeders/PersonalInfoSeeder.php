<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalInfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('personal_infos')->truncate();

        $personalInfo=[
            ['key'=>'name','value'=>'Mohamed'],
            ['key'=>'Email','value'=>'ramyalfe22@gmail.com'],
            ['key'=>'age','value'=>24],
            ['key'=>'country','value'=>'Egypt'],
            ['key'=>'city','value'=>'Tanta'],
            ['key'=>'photo','value'=>'default.jpg'],
        ];
        DB::table('personal_infos')->insert($personalInfo);
    }
}
