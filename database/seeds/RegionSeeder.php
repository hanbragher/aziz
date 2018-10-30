<?php

use Illuminate\Database\Seeder;
use Azizner\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(
            [
                'name' => 'Lori',
                'country_id' => 1,

            ]
        );
    }
}
