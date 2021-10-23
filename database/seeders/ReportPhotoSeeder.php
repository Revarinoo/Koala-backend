<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $report_photos = [
            [
                'id' => 1,
                'report_id' => 1,
                'photo' => 'kopikenangan_post_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 2,
                'report_id' => 2,
                'photo' => 'kopikenangan_story_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 3,
                'report_id' => 3,
                'photo' => 'starbucks_post_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 4,
                'report_id' => 4,
                'photo' => 'starbucks_story_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 5,
                'report_id' => 5,
                'photo' => 'burgerking_post_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ],
            [
                'id' => 6,
                'report_id' => 6,
                'photo' => 'burgerking_story_report',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
            ]
        ];
        DB::table('reporting_photos')->insert($report_photos);
    }
}
