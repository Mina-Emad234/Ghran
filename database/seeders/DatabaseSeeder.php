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
        $this->call(SettingsSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(PhotoSeeder::class);
        $this->call(BlogTagSeeder::class);
        $this->call(CourseSeeder::class);
    }
}
