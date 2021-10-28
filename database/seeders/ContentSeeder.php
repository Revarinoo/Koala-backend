<?php

namespace Database\Seeders;

use App\Models\Utility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [   'id' => 1,
                'name'=>'Birthday Campaign',
                'description'=>"Introduction\nMy Coffee is a coffee shop located in South Jakarta. Famous for our iced americano that brewed to perfection to help start your day and caramel latte with creamy texture yet refreshing to slow down your pace in the busy life.",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_name'=>"1x Iced Americano",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"birthday.jpg",
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'name'=>'12.12 Campaign',
                'description'=>"Introduction\nMy Coffee is a coffee shop located in South Jakarta. Famous for our iced americano that brewed to perfection to help start your day and caramel latte with creamy texture yet refreshing to slow down your pace in the busy life.",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_name'=>"1x Iced Macchiato",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"12.jpg",
                'business_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'name'=>'New Product Campaign',
                'description'=>"Introduction\nMy Coffee is a coffee shop located in South Jakarta. Famous for our iced americano that brewed to perfection to help start your day and caramel latte with creamy texture yet refreshing to slow down your pace in the busy life.",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_name'=>"1x Iced Latter",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"newproduct.png",
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('contents')->insert($contents);
    }

}
