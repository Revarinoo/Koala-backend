<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [   'id' => 1,
                'name' => "Elon Musk",
                'email' => "elonmusk".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 36,
                'location' => "California",
                'photo' => "elonmusk.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')        
            ], 
            [
                'id' => 2,
                'name' => "Raditya Dika",
                'email' => "radityadika".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 35,
                'location' => "Jakarta Barat",
                'photo' => "radityadika.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => "Sisca Kohl",
                'email' => "siscakohl".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 22,
                'location' => "Jakarta Utara",
                'photo' => "siscakohl.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => "Asoka Remadjas",
                'email' => "asokaremadjas".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 29,
                'location' => "Jakarta Selatan",
                'photo' => "asokaremadjas.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'name' => "Erika Natalia",
                'email' => "erikanatalia".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 21,
                'location' => "Semarang",
                'photo' => "erikanatalia.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'name' => "Hans Daniel",
                'email' => "hansdaniel".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 26,
                'location' => "Jakarta Selatan",
                'photo' => "hansdaniel.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'name' => "Alex Ferdinand",
                'email' => "alexferdy".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 33,
                'location' => "Bandung",
                'photo' => "alexferdy.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'name' => "Magdalena",
                'email' => "magdalena12".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 26,
                'location' => "Tangerang",
                'photo' => "magdalena.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'name' => "Tanboy Kun",
                'email' => "tanboy65".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 42,
                'location' => "Surabaya",
                'photo' => "tanboykun.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'name' => "Titan Tyra",
                'email' => "titan1993".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 36,
                'location' => "Jakarta Utara",
                'photo' => "titantyra.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'name' => "Baim Wong",
                'email' => "baimwng".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 37,
                'location' => "Jakarta Utara",
                'photo' => "baimwong.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'name' => "Anya Geraldine",
                'email' => "anyagrld".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 27,
                'location' => "Jakarta Selatan",
                'photo' => "anyageraldine.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'name' => "Citra Kirana",
                'email' => "citra124".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 24,
                'location' => "Jakarta Timur",
                'photo' => "citrakirana.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'name' => "Gina Angelia",
                'email' => "ginang".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 24,
                'location' => "Jakarta Timur",
                'photo' => "ginaangelia.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'name' => "Tasya Farasya",
                'email' => "tasyafarr".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 26,
                'location' => "Jakarta Barat",
                'photo' => "tasyafarasya.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'name' => "Yuki Kato",
                'email' => "yukii99".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 28,
                'location' => "Jakarta Timur",
                'photo' => "yukikato.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'name' => "Tom Jerry",
                'email' => "tomjerry".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 42,
                'location' => "Jakarta Barat",
                'photo' => "tomjerry.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 18,
                'name' => "David Edgy",
                'email' => "davedgyworld".'@gmail.com',
                'password' => Hash::make('123456'),
                'age' => 38,
                'location' => "Bekasi",
                'photo' => "davidedgy.png",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        DB::table('users')->insert($users);
    }
}
