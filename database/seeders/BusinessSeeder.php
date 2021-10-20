<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = [
            [   'id' => 1,
                'business_name' => "Elonshop",
                'website' => "https://elonmusk.com",
                'instagram' => "elonolshop",
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ]
        ];

        DB::table('businesses')->insert($businesses);
    }
}
