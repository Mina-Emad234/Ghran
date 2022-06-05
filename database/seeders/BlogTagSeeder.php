<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\DB::table('blog_categories')->pluck('name')->toArray() as $category) {
            $images = glob(public_path('uploads/blogs/' .$category.'/*.*'));
            foreach ($images as $image) {
                unlink($image);
            }
        }
        DB::table('blog_tag')->truncate();
        Schema::disableForeignKeyConstraints();
        Blog::truncate();
        Schema::enableForeignKeyConstraints();
        Blog::factory(80)->create()->each(function($blog) {
            $blog->tags()->sync(
                Tag::all()->random(3)
            );
        });
    }
}
