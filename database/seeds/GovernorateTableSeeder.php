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
            'الاسكندرية',
            'بورسعيد',
            'الاسماعيلية',
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
            'اسيوط',
            'أسوان',
            'مطروح',
            'البحر الأحمر',
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

        $map_keys = [
            'EGY1533',
            'EGY1543',
            'EGY1538',
            'EGY1531',
            'EGY1539',
            'EGY1537',
            'EGY1535',
            'EGY1534',
            'EGY1547',
            'EGY1530',
            'EGY1532',
            'EGY1541',
            'EGY1544',
            'EGY1542',
            'EGY1545',
            'EGY1549',
            'EGY1548',
            'EGY1540',
            'EGY1556',
        ];

        for ($i=0; $i < 19; $i++) { 
            DB::table('governorates')->insert([
                'name_ar' => $governorates_ar[$i],
                'name_en' => $governorates_en[$i],
                'map_key' => $map_keys[$i]
            ]);
        }
    }
}

