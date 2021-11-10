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
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => date('Y.m.d',strtotime("+10 days")),
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
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => date('Y.m.d',strtotime("+10 days")),
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
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => date('Y.m.d',strtotime("+10 days")),
                'product_name'=>"1x Iced Latter",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"newproduct.png",
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 4,
                'name'=>'Boba Campaign',
                'description'=>"Introduction\nBrown Sugar Ombré Effect presented inside the edge of our signature Brown Sugar Boba Milk is named our ‘happiness pattern’ by Xing Fu Tong’s Founder. Xing Fu means ‘happiness’ in Chinese.",
                'start_date' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'end_date' => Carbon::now()->format('Y-m-d'),
                'product_name'=>"1x Brown Sugar Boba Milk",
                'rules'=> "Must show that you drink the boba.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"bobacampaign.jpeg",
                'business_id'=> 1,
                'created_at' => Carbon::now()->subDays(60)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 5,
                'name'=>'Pretzel Campaign',
                'description'=>"You can count the ingredients in our hand-held snacks on one hand. And that’s how snacking should be.",
                'start_date' => Carbon::now()->subDays(90)->format('Y-m-d'),
                'end_date' => Carbon::now()->subDays(30)->format('Y-m-d'),
                'product_name'=>"1x Original Pretzel",
                'rules'=> "Must show that you eat the pretzel.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'campaign_logo'=>"pretzelcampaign.jpeg",
                'business_id'=> 1,
                'created_at' => Carbon::now()->subDays(90)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('contents')->insert($contents);
    }

}
