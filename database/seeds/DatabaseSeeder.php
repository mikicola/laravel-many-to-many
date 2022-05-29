<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // l'ordine è importante, post dipende dalla categoria va sotto categoria

        $this->call(UserSeeder::class);

        $this->call(UserInfoSeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(PostSeeder::class);

        $this->call(TagSeeder::class);

        $this->call(PostTagSeeder::class);


    }
}
