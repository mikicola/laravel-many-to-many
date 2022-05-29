<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name'      => 'io',
            'email'     => 'io@io.io',
            'password'  => Hash::make('12345678'),
        ]);

        for ($i = 0; $i < 10; $i++){
            // serve solo name, mail e password, il resto lo gestisce laravel
            User::create([
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('password'),
            ]);
        }
    }
}
