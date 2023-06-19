<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i <= 100 ; $i++) {



            User::create([
                'name' => $faker->name(),
                'image'=> '1682429678716.jpg',
                'address' => $faker->address,
                'status' => $faker->randomElement([0,1]),
                'gender' => $faker->randomElement(['male','female']),
                'balance' => $faker->unique()->numberBetween(30,100),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => \Hash::make('password'),
                'remember_token' => \Str::random(10),
            ]);

        }

    }
}
