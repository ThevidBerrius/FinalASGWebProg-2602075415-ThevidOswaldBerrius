<?php

namespace Database\Seeders;

use App\Models\FieldOfWork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldOfWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            'Accountant',
            'Architect',
            'Artist',
            'Business Analyst',
            'Computer Programmer',
            'Consultant',
            'Data Scientist',
            'Dentist',
            'Designer',
            'Electrician',
        ];

        foreach($fields as $field){
            FieldOfWork::create([
                'name' => $field,
            ]);
        }
    }
}
