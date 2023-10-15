<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingsTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        //$this->call(GradeSeeder::class);
        //$this->call(ClassroomSeeder::class);
        //$this->call(SectionSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(religionTableSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
         //$this->call(ParentSeeder::class);
         //$this->call(StudentsTableSeeder::class);
         // $this->call(SettingsTableSeeder::class);
        $this->call(PersonalInfoSeeder::class);
    }
}
