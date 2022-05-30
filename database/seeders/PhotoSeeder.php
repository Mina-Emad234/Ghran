<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = glob(public_path('uploads/photos/*.*'));
        foreach ($images as $image) {
            unlink($image);
        }
        Photo::truncate();
        Photo::factory(100)->create();
    }
}
