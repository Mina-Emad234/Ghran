<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = glob(public_path('uploads/partners/*.*'));
        foreach ($images as $image) {
            unlink($image);
        }
        Partner::truncate();
        Partner::factory(15)->create();
    }
}
