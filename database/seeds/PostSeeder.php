<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use App\Category;
use Faker\Generator as Faker;

// per ordinare l'url
use illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $title = 'prova con titoli uguali';
        Post::create([
            'user_id'   => 1,
            'category_id' => 1,
            'title'     => $title,
            'content'   => $faker->text(rand(100, 800)),
            'slug'      => Post::generateSlug($title)
        ]);
        Post::create([
            'user_id'   => 2,
            'category_id' => 2,
            'title'     => $title,
            'content'   => $faker->text(rand(100, 800)),
            'slug'      => Post::generateSlug($title)
        ]);
        Post::create([
            'user_id'   => 3,
            'category_id' => 3,
            'title'     => $title,
            'content'   => $faker->text(rand(100, 800)),
            'slug'      => Post::generateSlug($title)
        ]);

        for ($i = 0; $i < 100; $i++){
            // $post = new Post();
            // per ordinare l'url
            $title =$faker->words(rand(2, 10), true);
            // $slug = $post->generateSlug($title);

            Post::create([
                // utenti random per i post
                'user_id'       => User::inRandomOrder()->first()->id,
                'category_id'   => Category::inRandomOrder()->first()->id,
                'title'         => $title,
                'content'       => $faker->text(rand(100, 800)),
                'slug'          => Post::generateSlug($title)
            ]);
        }
    }
}
