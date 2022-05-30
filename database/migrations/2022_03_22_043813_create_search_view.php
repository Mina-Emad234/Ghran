<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSearchView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_search_data AS
                SELECT
                   name as title,
                   concat('/posts/',slug) as link,
                   null as body
                FROM blog_categories
                UNION SELECT
                    title,
                   concat('/posts/show/',slug) as link,
                   body
                FROM blogs
                    UNION SELECT
                    name as title,
                   concat('/posts/tag_blog/',slug) as link,
                   null as body
                FROM tags
                    UNION SELECT
                    name as title,
                    concat('/courses/videos/',id) as link,
                    description as body
                FROM courses where course_payable = 0
                UNION SELECT
                    name as title,
                    concat('/course_applicants/register/',id) as link,
                    description as body
                FROM courses  where course_payable = 1
                UNION SELECT
                    name as title,
                    concat('/courses/video/',id) as link,
                     null as body
                FROM videos
                UNION SELECT
                 name as title,
                   concat('/album_categories/photos/',slug) as link,
                   null as body
                 FROM albums
                UNION SELECT
                name as title,
                   '/partners' as link,
                   null as body
                FROM partners
                UNION SELECT
                site_contents.title,
                   concat('/pages/',site_sections.name,'#',site_contents.id) as link,
                   site_contents.body
                FROM site_contents join site_sections on site_contents.site_section_id = site_sections.id
                UNION SELECT
                name as title,
                 link,
                 null as body
                FROM site_links
            SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_search_data`;
            SQL;
    }
}
