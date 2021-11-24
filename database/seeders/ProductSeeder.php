<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [   'id' => 1,
                'product_type' => "Instagram Post",
                'min_rate' => 1000000,
                'max_rate'=>1500000,
                'influencer_id' => 1,
                'platform_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'product_type' => "Instagram Story",
                'min_rate' => 700000,
                'max_rate'=>1000000,
                'influencer_id' => 1,
                'platform_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'product_type' => "Instagram Post",
                'min_rate' => 1500000,
                'max_rate'=>2500000,
                'influencer_id' => 2,
                'platform_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 4,
                'product_type' => "Instagram Story",
                'min_rate' => 1000000,
                'max_rate'=>1500000,
                'influencer_id' => 2,
                'platform_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 31,
                'product_type' => "Instagram Story",
                'min_rate' => 1500000,
                'max_rate'=>2500000,
                'influencer_id' => 2,
                'platform_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 5,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 3,
                'platform_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 6,
                'product_type' => "Instagram Story",
                'min_rate' => 500000,
                'max_rate'=>2000000,
                'influencer_id' => 3,
                'platform_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 7,
                'product_type' => "Instagram Post",
                'min_rate' => 1200000,
                'max_rate'=>2300000,
                'influencer_id' => 4,
                'platform_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 8,
                'product_type' => "Instagram Story",
                'min_rate' => 800000,
                'max_rate'=>4000000,
                'influencer_id' => 4,
                'platform_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 9,
                'product_type' => "Instagram Post",
                'min_rate' => 1800000,
                'max_rate'=>6000000,
                'influencer_id' => 5,
                'platform_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 10,
                'product_type' => "Instagram Story",
                'min_rate' => 700000,
                'max_rate'=>1200000,
                'influencer_id' => 5,
                'platform_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 11,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 6,
                'platform_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 12,
                'product_type' => "Instagram Story",
                'min_rate' => 700000,
                'max_rate'=>1200000,
                'influencer_id' => 6,
                'platform_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 13,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 7,
                'platform_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 14,
                'product_type' => "Instagram Story",
                'min_rate' => 700000,
                'max_rate'=>1200000,
                'influencer_id' => 7,
                'platform_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 15,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 8,
                'platform_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 16,
                'product_type' => "Instagram Story",
                'min_rate' => 300000,
                'max_rate'=>1000000,
                'influencer_id' => 8,
                'platform_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 17,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 9,
                'platform_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 18,
                'product_type' => "Instagram Story",
                'min_rate' => 800000,
                'max_rate'=>1000000,
                'influencer_id' => 9,
                'platform_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 19,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3100000,
                'influencer_id' => 10,
                'platform_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 20,
                'product_type' => "Instagram Story",
                'min_rate' => 800000,
                'max_rate'=>1600000,
                'influencer_id' => 10,
                'platform_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 21,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>6000000,
                'influencer_id' => 11,
                'platform_id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 22,
                'product_type' => "Instagram Story",
                'min_rate' => 1000000,
                'max_rate'=>3000000,
                'influencer_id' => 11,
                'platform_id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 23,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 12,
                'platform_id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 24,
                'product_type' => "Instagram Story",
                'min_rate' => 400000,
                'max_rate'=>1000000,
                'influencer_id' => 12,
                'platform_id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 25,
                'product_type' => "Instagram Post",
                'min_rate' => 800000,
                'max_rate'=>3000000,
                'influencer_id' => 13,
                'platform_id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 26,
                'product_type' => "Instagram Story",
                'min_rate' => 500000,
                'max_rate'=>2000000,
                'influencer_id' => 13,
                'platform_id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 27,
                'product_type' => "Instagram Post",
                'min_rate' => 2100000,
                'max_rate'=>12000000,
                'influencer_id' => 14,
                'platform_id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 28,
                'product_type' => "Instagram Story",
                'min_rate' => 800000,
                'max_rate'=>1000000,
                'influencer_id' => 14,
                'platform_id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 29,
                'product_type' => "Instagram Post",
                'min_rate' => 1800000,
                'max_rate'=>13000000,
                'influencer_id' => 15,
                'platform_id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 30,
                'product_type' => "Instagram Story",
                'min_rate' => 800000,
                'max_rate'=>1300000,
                'influencer_id' => 15,
                'platform_id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        DB::table('products')->insert($products);
    }
}
