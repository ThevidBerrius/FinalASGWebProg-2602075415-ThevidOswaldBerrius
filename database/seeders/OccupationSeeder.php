<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Occupation::create(['name' => 'Accountant']);
        Occupation::create(['name' => 'Architect']);
        Occupation::create(['name' => 'Artist']);
        Occupation::create(['name' => 'Computer Programmer']);
        Occupation::create(['name' => 'Data Scientist']);
    }
}
