<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    public function run()
    {
        DB::table('sections')->delete();

        $sections=[
            ['en'=>'A','ar'=>'أ'],
            ['en'=>'B','ar'=>'ب'],
            ['en'=>'C','ar'=>'ج'],
        ];

        foreach ($sections as $section){
            Section::create([
                'Name_Section'=>$section,
                'Grade_id'=>Grade::all()->unique()->random()->id,
                'Class_id'=>Classroom::all()->unique()->random()->id,
                'Status'=>random_int(0,1),
            ]);
        }
    }
}
