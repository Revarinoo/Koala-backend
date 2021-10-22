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
                'instruction' => "Introduction: \nSultan boba ini merupakan kolaborasi spesial antara Kopi Kenangan dengan Sultan Hotman Paris yang menggunakan boba asli Taiwan. Sultan Boba bisa dinikmati dengan varian Milk Tea terbaru dari Kopi Kenangan ataupun dijadikan ekstra topping di minuman favorit kamu!. Buat yang belum coba, beli sekarang yuk!\nHashtag:\n #KopiKenangan #4TahunKopiKenangan \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ],
            [   'id' => 2,
                'instruction' => "Introduction: \nServed cold, straight from the tap, our Nitro Cold Brew is topped with a float of house-made vanilla sweet cream. The result: a cascade of velvety coffee that is more sippable than ever.\nHashtag:\n #Starbucks_ID #NitroColdBrew \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ],
            [   'id' => 3,
                'instruction' => "Introduction: \nTersedia sekarang Beef Burger Purple Seoul dengan daging sapi panggang asli Australia, special sweet spicy soy sauce, fried purple cabbage, 2pc long rasher, shredded mozzarella dan pastinya bun bertabur wijen lembut khas Burger King.\nHashtag:\n #BurgerKing #BKPurpleSeoul \nPosts:\nInstagram Post x1\nInstagram Story x1",
                'schedule' => Carbon::now()->format('Y-m-d'),
                'business_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')            
            ],
        ];
        DB::table('contents')->insert($contents);
    }
    
}
