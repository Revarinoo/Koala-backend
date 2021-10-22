<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            BusinessSeeder::class,
            InfluencerSeeder::class,
            CategorySeeder::class,
            PlatformSeeder::class,
            ProductSeeder::class,
            ContentSeeder::class,
            ContentPhotoSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
