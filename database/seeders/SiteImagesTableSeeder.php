<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('site_images')->delete();
        
        \DB::table('site_images')->insert(array (
            0 => 
            array (
                'id' => 1,
                'site_section_id' => 1,
                'image' => '1649787280.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'site_section_id' => 2,
                'image' => '1647739713.jpg',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'site_section_id' => 3,
                'image' => '1647739832.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'site_section_id' => 4,
                'image' => '1647739847.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}