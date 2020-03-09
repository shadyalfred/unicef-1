<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country_ar = [
            'سوريا',
            'أخرى',
            'فلسطين',
            'العراق',
            'ليبيا',
            'السودان',
            'جنوب السودان',
            'اريتريا',
            'الصومال',
            'اليمن',
        ];

        $country_en = [
            'Syria',
            'Other',
            'Palestine',
            'Iraq',
            'Libya',
            'Sudan',
            'South Sudan',
            'Eritrea',
            'Somalia',
            'Yemen',
        ];

        for ($i = 0; $i < 10; $i++) {
            DB::table('countries')->insert([
                'country_ar' => $country_ar[$i],
                'country_en' => $country_en[$i]
            ]);
        }

    }
}
