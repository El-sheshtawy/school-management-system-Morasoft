<?php

namespace Database\Seeders;

use App\Models\Grade;
use Egulias\EmailValidator\Validation\DNSGetRecordWrapper;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    public function run()
    {

        DB::table('Grades')->delete();

        $gradesNames = [
            ['en' => 'primary stage', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'middle stage', 'ar' => 'المرحلة المتوسطة'],
            ['en' => 'High school', 'ar' => 'المرحلة الثانوية'],
        ];

        $Notes = [
            'This is the primary stage',
             'This is the middle stage',
            'This is the high school',
        ];

        for ($i = 0; $i <= 2; $i++) {
            Grade::create([
                'Name' => $gradesNames[$i],
                'Notes'=>$Notes[$i],
            ]);
        }
    }
}
