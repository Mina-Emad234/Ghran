<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
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
        foreach(\DB::table('albums')->pluck('name')->toArray() as $album) {
            if(FILE::isDirectory(public_path('uploads/photos/'.$album))){
                FILE::deleteDirectories(public_path('uploads/photos/' . $album));
            }
        }
            $images = glob(public_path('uploads/albums/".$album./*.*'));
            foreach ($images as $image) {
                unlink($image);
            }

        Schema::disableForeignKeyConstraints();
        Album::truncate();
        Schema::enableForeignKeyConstraints();
        Album::factory(11)->create();
        foreach(\DB::table('albums')->pluck('name')->toArray() as $album){
            FILE::makeDirectory(public_path('uploads/photos/'.$album),0777,true,true);
        }
    }
}
