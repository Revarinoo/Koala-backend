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
            [
                'id' => 5,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 20350,
                'likes' => 2340,
                'comments' => 77,
                'impressions' => 18300,
                'reach' => 1330,
                'order_detail_id'=> 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 7855,
                'likes' => 1183,
                'comments' => 58,
                'impressions' => 5300,
                'reach' => 2930,
                'order_detail_id'=> 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 798450,
                'likes' => 390433,
                'comments' => 3433,
                'impressions' => 689300,
                'reach' => 100930,
                'order_detail_id'=> 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 120154,
                'likes' => 60898,
                'comments' => 594,
                'impressions' => 89300,
                'reach' => 2930,
                'order_detail_id'=> 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 33837,
                'likes' => 2789,
                'comments' => 250,
                'impressions' => 30233,
                'reach' => 3679,
                'order_detail_id'=> 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 8923,
                'likes' => 1898,
                'comments' => 63,
                'impressions' => 7822,
                'reach' => 1113,
                'order_detail_id'=> 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 109154,
                'likes' => 684133,
                'comments' => 423594,
                'impressions' => 893300,
                'reach' => 129230,
                'order_detail_id'=> 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('reportings')->insert($reports);
    }
}
