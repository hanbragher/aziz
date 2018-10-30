<?php

use Illuminate\Database\Seeder;
use Azizner\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(
            [
                'name' => 'Vanadzor',
                'region_id' => 1,

            ]
        );
    }
}
