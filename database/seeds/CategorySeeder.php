<?php

use Illuminate\Database\Seeder;
use Azizner\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $categoryNames = [
        "all",
        "monastery",
        "church",
        "museum",
        "park",
        "square",
        "shop",
        "food",
        "education",
        "rest",
        "state institution",
        "other",
    ];

    public function run()
    {
        foreach ($this->categoryNames as $categoryName)
            Category::create(
                ['name' => $categoryName]
            );
    }
}
