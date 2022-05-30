<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = glob(public_path('uploads/albums/*.*'));
        foreach ($images as $image) {
            unlink($image);
        }
        Schema::disableForeignKeyConstraints();
        Album::truncate();
        Schema::enableForeignKeyConstraints();
        Album::factory(11)->create();
    }
}
