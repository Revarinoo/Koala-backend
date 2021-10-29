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
                'views' => 1240530,
                'likes' => 63240,
                'comments' => 1343,
                'impressions' => 931300,
                'reach' => 398230,
                'order_detail_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'post_url' => "https://www.instagram.com/p/CUbumHlBdAr/?utm_source=ig_web_copy_link",
                'views' => 633320,
                'likes' => 0,
                'comments' => 0,
                'impressions' => 531300,
                'reach' => 172930,
                'order_detail_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'post_url' => "https://www.instagram.com/p/CVSPnj1MzXM/?utm_source=ig_web_copy_link",
                'views' => 1645033,
                'likes' => 90244,
                'comments' => 2230,
                'impressions' => 923425,
                'reach' => 235523,
                'order_detail_id'=> 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'post_url' => "https://www.instagram.com/p/CVUZ74_F_tZ/?utm_source=ig_web_copy_link",
                'views' => 894230,
                'likes' => 102240,
                'comments' => 1377,
                'impressions' => 731300,
                'reach' => 272930,
                'order_detail_id'=> 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('reportings')->insert($reports);
    }
}
