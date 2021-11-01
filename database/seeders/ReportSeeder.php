<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = [
            [
                'id' => 1,
                'post_url' => "https://www.instagram.com/p/CUbumHlBdAr/?utm_source=ig_web_copy_link",
                'views' => 95530,
                'likes' => 43240,
                'comments' => 1343,
                'impressions' => 73300,
                'reach' => 18230,
                'order_detail_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'post_url' => "https://www.instagram.com/p/CUbumHlBdAr/?utm_source=ig_web_copy_link",
                'views' => 75320,
                'likes' => 0,
                'comments' => 0,
                'impressions' => 51300,
                'reach' => 22930,
                'order_detail_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'post_url' => "https://www.instagram.com/p/CVSPnj1MzXM/?utm_source=ig_web_copy_link",
                'views' => 105033,
                'likes' => 30244,
                'comments' => 2230,
                'impressions' => 93425,
                'reach' => 25523,
                'order_detail_id'=> 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 99230,
                'likes' => 23240,
                'comments' => 1377,
                'impressions' => 83300,
                'reach' => 17930,
                'order_detail_id'=> 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('reportings')->insert($reports);
    }
}
