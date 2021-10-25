<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InfluencerAnalyticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $influencer_analytics = [
            [
                'id' => 1,
                'influencer_id' => 1,
                'photo' => "top_location",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 2,
                'influencer_id' => 1,
                'photo' => "age_range",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 3,
                'influencer_id' => 1,
                'photo' => "gender",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 4,
                'influencer_id' => 2,
                'photo' => "top_location",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 5,
                'influencer_id' => 2,
                'photo' => "age_range",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 6,
                'influencer_id' => 2,
                'photo' => "gender",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 7,
                'influencer_id' => 5,
                'photo' => "top_location",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 8,
                'influencer_id' => 5,
                'photo' => "age_range",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 9,
                'influencer_id' => 5,
                'photo' => "gender",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 10,
                'influencer_id' => 6,
                'photo' => "top_location",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 11,
                'influencer_id' => 6,
                'photo' => "age_range",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 12,
                'influencer_id' => 6,
                'photo' => "gender",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 13,
                'influencer_id' => 9,
                'photo' => "top_location",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 14,
                'influencer_id' => 9,
                'photo' => "age_range",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 15,
                'influencer_id' => 9,
                'photo' => "gender",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ]
        ];
        DB::table('influencer_analytics')->insert($influencer_analytics);
    }
}
