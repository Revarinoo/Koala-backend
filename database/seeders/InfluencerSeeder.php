<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InfluencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $influencers = [
            [   'id' => 1,
                'rating' => 3.0,
                'contact_email' => "raditss@gmail.com",
                'engagement_rate'=> 43.7,
                'user_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'rating' => 4.3,
                'contact_email' => "siskohlme@gmail.com",
                'engagement_rate'=> 23.7,
                'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'rating' => 3.2,
                'contact_email' => "asokaremadjas@gmail.com",
                'engagement_rate'=> 33.7,
                'user_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'rating' => 4.0,
                'contact_email' => "erikanatalia@yahoo.com",
                'engagement_rate'=> 13.7,
                'user_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'rating' => 4.5,
                'contact_email' => "hansdaniel@gmail.com",
                'engagement_rate'=> 12.7,
                'user_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'rating' => 3.5,
                'contact_email' => "alexferdinand@gmail.com",
                'engagement_rate'=> 31.7,
                'user_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'rating' => 4.8,
                'contact_email' => "magdalena@gmail.com",
                'engagement_rate'=> 41.7,
                'user_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'rating' => 3.4,
                'contact_email' => "tanboykun@yahoo.com",
                'engagement_rate'=> 10.3,
                'user_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'rating' => 4.7,
                'contact_email' => "titantyra@gmail.com",
                'engagement_rate'=> 11.7,
                'user_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'rating' => 4.9,
                'contact_email' => "baimwong@gmail.com",
                'engagement_rate'=> 13.2,
                'user_id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'rating' => 5.0,
                'contact_email' => "anyageraldine@gmail.com",
                'engagement_rate'=> 50,
                'user_id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'rating' => 5.0,
                'contact_email' => "citrakirana@yahoo.com",
                'engagement_rate'=> 35.7,
                'user_id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'rating' => 3.7,
                'contact_email' => "ginaangelia@gmail.com",
                'engagement_rate'=> 11.4,
                'user_id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'rating' => 3.2,
                'contact_email' => "tasyafarasya@gmail.com",
                'engagement_rate'=> 21.7,
                'user_id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'rating' => 5.0,
                'contact_email' => "yukikato@yahoo.com",
                'engagement_rate'=> 10.1,
                'user_id' => 16,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        DB::table('influencers')->insert($influencers);
    }
}
