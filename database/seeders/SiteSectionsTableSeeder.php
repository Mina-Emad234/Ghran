<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteSectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('site_sections')->delete();
        
        \DB::table('site_sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'main',
                'section_type' => 'images',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'support',
                'section_type' => 'images',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'header_logo',
                'section_type' => 'images',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'footer_logo',
                'section_type' => 'images',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'about',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'support',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'members',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'programs',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'offers',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'footer_top',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'footer_bottom',
                'section_type' => 'pages',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'header_links',
                'section_type' => 'front links',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'sitemap_links',
                'section_type' => 'front links',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'footer_about_links',
                'section_type' => 'front links',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'footer_content_links',
                'section_type' => 'front links',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 18,
                'name' => 'المنشورات',
                'section_type' => 'images',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}