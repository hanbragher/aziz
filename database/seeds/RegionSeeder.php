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

    private $regionNames = [
        "Lori",
        "Aragatsotn",
        "Ararat",
        "Armavir",
        "Gegharkunik",
        "Kotayk",
        "Shirak",
        "Syunik",
        "Tavush",
        "Vayots Dzor",
        "Yerevan"
    ];

    public function run()
    {
        foreach ($this->regionNames as $regionName)
            Region::create(
                [
                    'name' => $regionName,
                    'country_id' => 1,
                ]
            );
    }


}
