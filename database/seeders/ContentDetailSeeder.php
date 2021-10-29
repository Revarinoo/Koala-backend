<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content_details = [
            [
                'id'=> 1,
                'content_id'=> 1,
                'content_type'=>"Instagram Post",
                'instruction' => "Introduction: \nHot boba ini merupakan kolaborasi spesial antara Kopi Memory dengan Hotgirl London yang menggunakan boba asli Taiwan. Hot Boba bisa dinikmati dengan varian Milk Tea terbaru dari Kopi Memory ataupun dijadikan ekstra topping di minuman favorit kamu!. Buat yang belum coba, beli sekarang yuk!\nHashtag:\n #KopiMemory #4TahunKopiMemory \nPosts:\nInstagram Post x1\nInstagram Story x1",
            ],
            [
                'id'=> 2,
                'content_id'=> 1,
                'content_type'=>"Instagram Story",
                'instruction' => "Follow Account @ikoy untuk dapat hadiah",
            ],
            [
                'id'=> 3,
                'content_id'=> 2,
                'content_type'=>"Instagram Post",
                'instruction' => "Introduction: \nServed cold, straight from the tap, our Nitro Cold Brew is topped with a float of house-made vanilla sweet cream. The result: a cascade of velvety coffee that is more sippable than ever.\nHashtag:\n #Moonbux #NitroColdBrew \nPosts:\nInstagram Post x1\nInstagram Story x1",
            ],
            [
                'id'=> 4,
                'content_id'=> 3,
                'content_type'=>"Instagram Post",
                'instruction' => "Introduction: \nTersedia sekarang Beef Burger Pink Seoul dengan daging sapi panggang asli Australia, special sweet spicy soy sauce, fried purple cabbage, 2pc long rasher, shredded mozzarella dan pastinya bun bertabur wijen lembut khas Burger Queen.\nHashtag:\n #BurgerQueen #BQPinkSeoul \nPosts:\nInstagram Post x1\nInstagram Story x1",
            ],
            [
                'id'=> 5,
                'content_id'=> 3,
                'content_type'=>"Instagram Reels",
                'instruction' => "Introduction: \nTersedia sekarang Beef Burger Pink Seoul dengan daging sapi panggang asli Australia, special sweet spicy soy sauce, fried purple cabbage, 2pc long rasher, shredded mozzarella dan pastinya bun bertabur wijen lembut khas Burger Queen.\nHashtag:\n #BurgerQueen #BQPinkSeoul \nPosts:\nInstagram Post x1\nInstagram Story x1",
            ],
            [
                'id'=> 6,
                'content_id'=> 2,
                'content_type'=>"Instagram Story",
                'instruction' => "Introduction: \nTersedia sekarang Beef Burger Pink Seoul dengan daging sapi panggang asli Australia, special sweet spicy soy sauce, fried purple cabbage, 2pc long rasher, shredded mozzarella dan pastinya bun bertabur wijen lembut khas Burger Queen.\nHashtag:\n #BurgerQueen #BQPinkSeoul \nPosts:\nInstagram Post x1\nInstagram Story x1",
            ]
        ];
        DB::table('content_details')->insert($content_details);
    }
}
