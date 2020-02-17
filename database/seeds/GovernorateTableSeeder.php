<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates_ar = [
            'القاهرة',
            'الأسكندرية',
            'بورسعيد',
            'الإسماعيلية',
            'دمياط',
            'الدقهلية',
            'الشرقية',
            'القليوبية',
            'كفر الشيخ',
            'الغربية',
            'المنوفية',
            'البحيرة',
            'الجيزة',
            'الفيوم',
            'المنيا',
            'أسيوط',
            'أسوان',
            'مطروح',
            'البحر الاحمر',
        ];

        $governorates_en = [
            'Cairo',
            'Alexandria',
            'Port Said',
            'Ismailia',
            'Damietta',
            'Dakahlia',
            'Sharqia',
            'Qalyubia',
            'Kafr El Sheikh',
            'Gharbia',
            'Monufia',
            'Beheira',
            'Giza',
            'Faiyum',
            'Minya',
            'Asyut',
            'Aswan',
            'Matruh',
            'Red Sea'
        ];

        for ($i=0; $i < 19; $i++) { 
            DB::table('governorates')->insert([
                'name_ar' => $governorates_ar[$i],
                'name_en' => $governorates_en[$i]
            ]);
        }

    }
}

