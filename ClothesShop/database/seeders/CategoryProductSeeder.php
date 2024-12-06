<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category_product')->insert([
            [
                'cat_name'=>'Áo thun',
                'cat_description'=>'',
                'cat_status'=>1
            ],
            [
                'cat_name'=>'Quần jean',
                'cat_description'=>'',
                'cat_status'=>1
            ],
            [
                'cat_name'=>'Quần kaki',
                'cat_description'=>'',
                'cat_status'=>1
            ],
            [
                'cat_name'=>'Áo khoác',
                'cat_description'=>'',
                'cat_status'=>1
            ],
            [
                'cat_name'=>'Giày sneaker',
                'cat_description'=>'',
                'cat_status'=>1
            ]
        ]);
    }
}
