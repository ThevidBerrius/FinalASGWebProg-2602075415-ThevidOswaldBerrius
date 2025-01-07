<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 1,
            'gender' => 'male',
            'linkedin_username' => 'https://www.linkedin.com/in/john-doe',
            'phone_number' => '081112223344',
            'experience_years' => 7,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 2,
            'gender' => 'female',
            'linkedin_username' => 'https://www.linkedin.com/in/jane-smith',
            'phone_number' => '081223344556',
            'experience_years' => 5,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Alice Brown',
            'email' => 'alice.brown@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 3,
            'gender' => 'female',
            'linkedin_username' => 'https://www.linkedin.com/in/alice-brown',
            'phone_number' => '081334455667',
            'experience_years' => 3,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Bob Williams',
            'email' => 'bob.williams@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 4,
            'gender' => 'male',
            'linkedin_username' => 'https://www.linkedin.com/in/bob-williams',
            'phone_number' => '081445566778',
            'experience_years' => 10,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Charlie Johnson',
            'email' => 'charlie.johnson@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 5,
            'gender' => 'male',
            'linkedin_username' => 'https://www.linkedin.com/in/charlie-johnson',
            'phone_number' => '081556677889',
            'experience_years' => 8,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Diana Rose',
            'email' => 'diana.rose@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 1,
            'gender' => 'female',
            'linkedin_username' => 'https://www.linkedin.com/in/diana-rose',
            'phone_number' => '081667788990',
            'experience_years' => 6,
            'avatar_id' => rand(1, 3),  
        ]);

        User::create([
            'name' => 'Eve Green',
            'email' => 'eve.green@gmail.com',
            'password' => Hash::make('password123'),
            'occupation_id' => 2,
            'gender' => 'female',
            'linkedin_username' => 'https://www.linkedin.com/in/eve-green',
            'phone_number' => '081778899001',
            'experience_years' => 4,
            'avatar_id' => rand(1, 3),  
        ]);
    }
}
