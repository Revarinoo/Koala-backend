<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [   'id' => 1,
                'status' => "Paid",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'influencer_id' => 2,
                'content_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')          
            ],
            [   'id' => 2,
                'status' => "Paid",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'influencer_id' => 2,
                'content_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')          
            ],
            [   'id' => 3,
                'status' => "Paid",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'influencer_id' => 2,
                'content_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')          
            ],
            
        ];
        DB::table('orders')->insert($orders);
    }
}
