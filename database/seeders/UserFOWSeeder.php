<?php

namespace Database\Seeders;

use App\Models\UserFOW;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFOWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            1 => [1, 2, 3],
            2 => [2, 3, 4],
            3 => [3, 4, 5],
            4 => [4, 5, 6],
            5 => [5, 6, 7],
            6 => [6, 7, 8],
            7 => [7, 8, 9],
        ];

        foreach($users as $user => $fows) {
            foreach($fows as $fow){
                UserFOW::create([
                    'user_id' => $user,
                    'field_of_work_id' => $fow,
                ]);
            }
        }
    }
}
