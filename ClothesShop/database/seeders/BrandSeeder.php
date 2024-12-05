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
                'brand_status'=>1
            ]
        ]);
    }
}
