<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            Package::create([
                'title' => $faker->name,
                'chat_credit' => $faker->randomDigit(),
                'cost'=>$faker->randomFloat(2,0,2)
            ]);
        }
    }
}
