<?php

use Illuminate\Database\Seeder;
use Azizner\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $tags = [
        "monastery",
        "church",
        "garden",
        "museum",
        "shop",
        "city",
        "green",
        "winter",
        "summer",
        "Armenia",
        "Lori",
        "Vanadzor",
        "beautiful",
        "unbelievable",
    ];

    public function run()
    {
        foreach ($this->tags as $tag)
            Tag::create(
                ['name' => $tag]
            );
    }
}
