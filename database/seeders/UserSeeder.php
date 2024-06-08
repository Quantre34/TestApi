<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'chat_credit' => $faker->randomDigit(),
                'is_premium'=> $faker->randomElement(['0' ,'1']),
                'password' => bcrypt('password'), // Şifreyi bcrypt ile şifreleyin
            ]);
        }
    }
}
