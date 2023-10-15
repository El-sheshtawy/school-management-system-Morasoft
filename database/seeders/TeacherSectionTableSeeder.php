<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSectionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teacher_section')->truncate();

        $data=[
            ['id'=>1,'teacher_id'=>1,'section_id'=>1,'grade_id'=>1]
        ];

        DB::table('teacher_section')->insert($data);
    }
}
