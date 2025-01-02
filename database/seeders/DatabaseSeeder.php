<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            OccupationSeeder::class,
            UserSeeder::class,
            FieldOfWorkSeeder::class,
            UserFOWSeeder::class,
            FriendSeeder::class,
            MessageSeeder::class,
            NotificationSeeder::class,
            AvatarSeeder::class,
        ]);
    }
}
