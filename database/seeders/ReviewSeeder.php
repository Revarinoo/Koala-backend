<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews= [
            [   'id' => 1,
                'comment' => "Amazing Work! In accordance to brief.",
                'rating' => 4.0,
                'order_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'comment' => "Creative content and amazing result of brand awareness.",
                'rating' => 4.0,
                'order_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'comment' => "Thank you! Satisfied with the work and worth the price.",
                'rating' => 5.0,
                'order_id'=> 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('reviews')->insert($reviews);
    }
}
