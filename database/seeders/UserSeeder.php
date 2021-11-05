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
                'photo' => "elonmusk.jpeg",
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
                'photo' => "radityadika.jpeg",
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
                'photo' => "siscakohl.jpg",
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
                'photo' => "asokaremadjas.jpeg",
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
                'photo' => "erikanatalia.jpeg",
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
                'photo' => "hansdaniel.jpeg",
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
                'photo' => "alexferdy.jpeg",
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
                'photo' => "magdalena.jpeg",
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
                'photo' => "tanboykun.jpeg",
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
                'photo' => "titantyra.jpeg",
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
                'photo' => "baimwong.jpeg",
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
                'photo' => "anyageraldine.jpeg",
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
                'photo' => "citrakirana.jpeg",
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
                'photo' => "ginaangelia.jpeg",
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
                'photo' => "tasyafarasya.jpeg",
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
                'photo' => "yukikato.jpeg",
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
                'photo' => "tomjerry.jpeg",
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
                'photo' => "davidedgy.jpeg",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        DB::table('users')->insert($users);
    }
}
