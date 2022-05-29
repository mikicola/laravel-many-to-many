<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'pizza',
            'pasta',
            'salad',
            'burger',
            'chicken',
            'fish',
            'soup',
            'dessert',
        ];

        foreach($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
