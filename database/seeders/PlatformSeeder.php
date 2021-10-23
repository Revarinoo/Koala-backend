<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            [   'id' => 1,
                'name' => "Instagram",
                'socialmedia_id' => "radityadika",
                'audience_age' => "17-30",
                'followers' => 17000000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => "Instagram",
                'socialmedia_id' => "siscakohl",
                'audience_age' => "12-25",
                'followers' => 7500000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => "Instagram",
                'socialmedia_id' => "asokaremadjas",
                'audience_age' => "22-30",
                'followers' => 63200,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => "Instagram",
                'socialmedia_id' => "erikanatalia",
                'audience_age' => "13-25",
                'followers' => 23700,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'name' => "Instagram",
                'socialmedia_id' => "hansdaniel",
                'audience_age' => "17-30",
                'followers' => 2200000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'name' => "Instagram",
                'socialmedia_id' => "alexfdn",
                'audience_age' => "12-25",
                'followers' => 8400000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'name' => "Instagram",
                'socialmedia_id' => "magdalena",
                'audience_age' => "22-30",
                'followers' => 3230000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'name' => "Instagram",
                'socialmedia_id' => "tanboykun",
                'audience_age' => "13-25",
                'followers' => 235000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'name' => "Instagram",
                'socialmedia_id' => "titantyra",
                'audience_age' => "17-30",
                'followers' => 197000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'id' => 10,
                'name' => "Instagram",
                'socialmedia_id' => "baimwong_12",
                'audience_age' => "12-25",
                'followers' => 2500000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'name' => "Instagram",
                'socialmedia_id' => "anyageraldine_",
                'audience_age' => "22-30",
                'followers' => 11000000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'name' => "Instagram",
                'socialmedia_id' => "citra_kirana",
                'audience_age' => "13-25",
                'followers' => 3300000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'name' => "Instagram",
                'socialmedia_id' => "ginangelia",
                'audience_age' => "17-30",
                'followers' => 2200000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'name' => "Instagram",
                'socialmedia_id' => "tasya_farr",
                'audience_age' => "12-25",
                'followers' => 250000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'name' => "Instagram",
                'socialmedia_id' => "yukikato",
                'audience_age' => "22-30",
                'followers' => 8800000,
                'engagement_rate'=> 43.7,
                'average_likes'=>1400.0,
                'average_comments'=>80.0,
                'influencer_id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        DB::table('platforms')->insert($platforms);
    }
}
