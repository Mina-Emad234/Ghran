<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BlogCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        foreach(\DB::table('blog_categories')->pluck('name')->toArray() as $category) {
            if(FILE::isDirectory(public_path('uploads/blogs/'.$category))){
                FILE::deleteDirectories(public_path('uploads/blogs/' . $category));
            }
        }
        \DB::table('blog_categories')->delete();

        \DB::table('blog_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'المقالات',
                'slug' => 'المقالات',
                'image' => '1648426856.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'الأخبار',
                'slug' => 'الأخبار',
                'image' => '1648426924.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'الأقسام النسائية',
                'slug' => 'الأقسام-النسائية',
                'image' => '1648427014.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'قالو عنا',
                'slug' => 'قالو-عنا',
                'image' => '1648427035.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        foreach(\DB::table('blog_categories')->pluck('name')->toArray() as $category){
            FILE::makeDirectory(public_path('uploads/blogs/'.$category),0755,true,true);
        }

    }
}
