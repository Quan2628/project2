<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('customer')->insert([
            [
                'cus_name'=>'Viktor Bùi',
                'cus_email'=>'Nghiax137@gmail.com',
                'cus_password'=>md5('123456789'),
                'cus_phone'=>'0967824511',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        ]);
    }
}
