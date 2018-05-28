<?php

use Illuminate\Database\Seeder;

class SpecsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpecsTableSeeder::class);
        $this->call(SpecsSettingsTableSeeder::class);
    }
}
