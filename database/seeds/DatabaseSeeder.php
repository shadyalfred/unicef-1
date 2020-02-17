<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('GovernorateTableSeeder');
        $this->command->info('Governorates table seeded!');

        $this->call('CountryTableSeeder');
        $this->command->info('Countries table seeded!');
    }
}
