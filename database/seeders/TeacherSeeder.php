<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->delete();
        Teacher::create([
            'name'=>['ar'=>'استاذ سمير','en'=>"Mr.Samir"],
            'email'=>'samir@teacher',
            'password'=>Hash::make('00000000'),
            'Address'=>'Amr allam Street',
            'Joining_Date'=>date('1981-4-14'),
            'Specialization_id'=>Specialization::all()->unique()->random()->id,
            'Gender_id'=>1,
            'created_at'=>date('Y-m-d'),
        ]);
    }
}
