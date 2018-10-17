<?php

use Illuminate\Database\Seeder;
use Azizner\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $groupNames = [
        "monastery",
        "church",
        "garden",
        "shop",
        "eat"
    ];

    public function run()
    {
        foreach ($this->groupNames as $groupName)
            Group::create(
                ['name' => $groupName]
            );
    }

}
