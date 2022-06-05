<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteLinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('site_links')->delete();
        
        \DB::table('site_links')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'االرئيسية',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/home',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'المنشورات',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/posts',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'الإستوديو',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/album_categories',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'عن اللجنة',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/pages/about',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'برامجنا',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/pages/programs',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'تطوع معنا',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'التسجيل في الكشافة',
                'site_section_id' => 12,
                'parent_id' => 6,
                'link' => '/scouts/register',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'الانتساب للمركز الإعلامي',
                'site_section_id' => 12,
                'parent_id' => 6,
                'link' => '/media_center/register',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'الانتساب للفريق التطوعي',
                'site_section_id' => 12,
                'parent_id' => 6,
                'link' => '/volunteer/register',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'شركاؤنا',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/our_partners',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'ادعمنا',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/pages/support',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'اتصل بنا',
                'site_section_id' => 12,
                'parent_id' => NULL,
                'link' => '/contact_us/register',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'نبذة عنا',
                'site_section_id' => 14,
                'parent_id' => NULL,
                'link' => '/pages/about',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'أعضاء اللجنة',
                'site_section_id' => 14,
                'parent_id' => NULL,
                'link' => '/pages/members',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'خريطة الموقع',
                'site_section_id' => 14,
                'parent_id' => NULL,
                'link' => '/pages/site_map',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'البحث',
                'site_section_id' => 14,
                'parent_id' => NULL,
                'link' => '/search',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'معلومات',
                'site_section_id' => 14,
                'parent_id' => NULL,
                'link' => '/pages/info',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'الرئيسية',
                'site_section_id' => 15,
                'parent_id' => NULL,
                'link' => '/home',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'name' => 'المنشورات',
                'site_section_id' => 15,
                'parent_id' => NULL,
                'link' => '/posts',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'name' => 'شركاؤنا',
                'site_section_id' => 15,
                'parent_id' => NULL,
                'link' => '/our_partners',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'name' => 'الكورسات المجانية',
                'site_section_id' => 15,
                'parent_id' => NULL,
                'link' => '/courses',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'name' => 'الكورسات المدفوعة',
                'site_section_id' => 15,
                'parent_id' => NULL,
                'link' => '/courses/payable',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 24,
                'name' => 'اتصل بنا',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/contact_us/register',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 25,
                'name' => 'ادعمنا',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/pages/support',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 26,
                'name' => 'شركاؤنا',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/our_partners',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 28,
                'name' => 'برامجنا',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/pages/programs',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 29,
                'name' => 'أعضاء اللجنة',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/pages/members',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 30,
                'name' => 'عن اللجنة',
                'site_section_id' => 13,
                'parent_id' => NULL,
                'link' => '/pages/about',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}