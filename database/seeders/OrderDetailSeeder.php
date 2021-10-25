<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_details = [
            [
                'id' => 1,
                'order_id' => 1,
                'report_id' => 1,
                'product_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 2,
                'order_id' => 1,
                'report_id' => 2,
                'product_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 3,
                'order_id' => 2,
                'report_id' => 3,
                'product_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 4,
                'order_id' => 2,
                'report_id' => 4,
                'product_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 5,
                'order_id' => 3,
                'report_id' => 5,
                'product_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 6,
                'order_id' => 3,
                'report_id' => 6,
                'product_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ]
        ];
        DB::table('order_details')->insert($order_details);
    }
}
