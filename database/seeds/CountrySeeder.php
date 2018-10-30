<?php

use Illuminate\Database\Seeder;
use Azizner\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $countryNames = [
        "Armenia",
        "Russia",
        "USA",
        "France",
        "Austria",
        "Italy",
        "Spain"
    ];

    public function run()
    {
        foreach ($this->countryNames as $countryName)
            Country::create(
                ['name' => $countryName]
            );
    }
}
