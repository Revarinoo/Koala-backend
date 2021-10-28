<?php

namespace Database\Seeders;

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
                'instruction' => "Introduction: \nHot boba ini merupakan kolaborasi spesial antara Kopi Memory dengan Hotgirl London yang menggunakan boba asli Taiwan. Hot Boba bisa dinikmati dengan varian Milk Tea terbaru dari Kopi Memory ataupun dijadikan ekstra topping di minuman favorit kamu!. Buat yang belum coba, beli sekarang yuk!\nHashtag:\n #KopiMemory #4TahunKopiMemory \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_campaign'=>"1x Iced Americano",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'type'=>"Instagram Post",
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'name'=>'12.12 Campaign',
                'description'=>"Introduction\nMy Coffee is a coffee shop located in South Jakarta. Famous for our iced americano that brewed to perfection to help start your day and caramel latte with creamy texture yet refreshing to slow down your pace in the busy life.",
                'instruction' => "Introduction: \nServed cold, straight from the tap, our Nitro Cold Brew is topped with a float of house-made vanilla sweet cream. The result: a cascade of velvety coffee that is more sippable than ever.\nHashtag:\n #Moonbux #NitroColdBrew \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_campaign'=>"1x Iced Macchiato",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'type'=>"Instagram Reels",
                'business_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'name'=>'New Product Campaign',
                'description'=>"Introduction\nMy Coffee is a coffee shop located in South Jakarta. Famous for our iced americano that brewed to perfection to help start your day and caramel latte with creamy texture yet refreshing to slow down your pace in the busy life.",
                'instruction' => "Introduction: \nTersedia sekarang Beef Burger Pink Seoul dengan daging sapi panggang asli Australia, special sweet spicy soy sauce, fried purple cabbage, 2pc long rasher, shredded mozzarella dan pastinya bun bertabur wijen lembut khas Burger Queen.\nHashtag:\n #BurgerQueen #BQPinkSeoul \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'product_campaign'=>"1x Iced Latter",
                'rules'=> "Must show that you drink the coffee.\nShow price of each products.\nMention all our location.\nTag us in the post",
                'type'=>"Instagram Post",
                'business_id'=> 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('contents')->insert($contents);
    }

}
