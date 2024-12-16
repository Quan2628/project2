<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('brand_product')->insert([
            [
                'brand_name'=>'TeeLab',
                'brand_description'=>'Trẻ trung, năng động',
                'brand_status'=>0
            ],
            [
                'brand_name'=>'Dior',
                'brand_description'=>'Sang trọng, lịch lãm',
                'brand_status'=>0
            ],
            [
                'brand_name'=>'Adidas',
                'brand_description'=>'',
                'brand_status'=>0
            ],
            [
                'brand_name'=>'TheNoob',
                'brand_description'=>'Phong cách thời trang',
                'brand_status'=>0
            ]
        ]);
    }
}
