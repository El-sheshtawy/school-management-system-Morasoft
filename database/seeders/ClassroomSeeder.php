<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{

    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms=[
            ['ar'=>'الصف الأول','en'=>'first class'],
            ['ar'=>'الصف الثاني','en'=>'second class'],
            ['ar'=>'الصف الثالث','en'=>'third class'],
        ];
        foreach ($classrooms as $classroom)
        {
            Classroom::create([
                'Name_Class'=>$classroom,
                'Grade_id'=>Grade::all()->unique()->random()->id,
            ]);
        }
    }
}
