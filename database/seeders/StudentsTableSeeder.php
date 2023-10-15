<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'ههند علام', 'en' => 'Mohanad Allam'];
        $students->email = 'noda@student';
        $students->password = Hash::make('12345678');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationalitie::all()->unique()->random()->id;
        $students->blood_id =Type_Blood::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = 1;
        $students->Classroom_id =1;
        $students->section_id = 1;
        $students->parent_id = 1;
        $students->academic_year ='2022';
        $students->save();

        Student::create([
            'name'=>['ar'=>'رامي علام','en'=>'Ramy Allam'],
            'email'=>'hamada@student',
            'password'=>Hash::make('00000000'),
            'gender_id'=>1,
            'nationalitie_id'=>Nationalitie::all()->random()->id,
            'blood_id'=>Type_Blood::all()->random()->id,
            'Date_Birth'=>date('1998-10-30'),
            'Grade_id'=>1,
            'Classroom_id'=>1,
            'section_id'=>2,
            'parent_id'=>1,
            'academic_year'=>'2022',
        ]);
    }
}
