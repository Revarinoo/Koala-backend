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
                'status' => "Completed",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'content_id'=> 1,
                'influencer_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'status' => "Completed",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'content_id'=> 2,
                'influencer_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'status' => "On Going",
                'order_date' => Carbon::now()->format('Y-m-d'),
                'content_id'=> 3,
                'influencer_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 4,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(55)->format('Y-m-d'),
                'content_id'=> 4,
                'influencer_id' => 3,
                'created_at' => Carbon::now()->subDays(55)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(45)->format('Y-m-d H:i:s')
            ],
            [   'id' => 5,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(24)->format('Y-m-d'),
                'content_id'=> 4,
                'influencer_id' => 4,
                'created_at' => Carbon::now()->subDays(24)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s')
            ],
            [   'id' => 6,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(35)->format('Y-m-d'),
                'content_id'=> 4,
                'influencer_id' => 7,
                'created_at' => Carbon::now()->subDays(35)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s')
            ],
            [   'id' => 7,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'content_id'=> 4,
                'influencer_id' => 8,
                'created_at' => Carbon::now()->subDays(4)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s')
            ],
            [   'id' => 8,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(85)->format('Y-m-d'),
                'content_id'=> 5,
                'influencer_id' => 3,
                'created_at' => Carbon::now()->subDays(85)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(75)->format('Y-m-d H:i:s')
            ],
            [   'id' => 9,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'content_id'=> 5,
                'influencer_id' => 4,
                'created_at' => Carbon::now()->subDays(60)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(65)->format('Y-m-d H:i:s')
            ],
            [   'id' => 10,
                'status' => "Completed",
                'order_date' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'content_id'=> 5,
                'influencer_id' => 7,
                'created_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('orders')->insert($orders);
    }
}
