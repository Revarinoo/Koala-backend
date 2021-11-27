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
                'business_name' => "Kopi Memory",
                'website' => "https://kopimemory.com",
                'instagram' => "kopi_memory",
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ],
            [   'id' => 2,
                'business_name' => "Moonbux",
                'website' => "https://moonbux.com",
                'instagram' => "moonbux",
                'user_id' => 17,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ],
            [   'id' => 3,
                'business_name' => "burgerqueen",
                'website' => "https://burgerqueen.com",
                'instagram' => "burgerqueen",
                'user_id' => 18,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ]
        ];

        DB::table('businesses')->insert($businesses);
    }
}
