<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        Setting::setMany([
            'Timezone'=>'AST',
            'Currency'=>"SAR",
            'Email'=>'info@tanmiyahergah.com',
            'Mobile'=>'0552077724',
            'Telefax'=>'0114801860',
            'Facebook'=>'https://www.facebook.com/',
            'Youtube'=>'https://www.youtube.com/',
            'Instagram'=>'https://www.instagram.com/',
            'Twitter'=>'https://www.twitter.com/',
            'MAIL_SERVER_USERNAME'=>'mina.emad.em1998@gmail.com',
            'MAIL_PASSWORD'=>'ukwjfxqmzcfttxtb',
            'RECAPTCHAV3_SITEKEY'=>'6LcabeAeAAAAAA76uG9RKOJqQCKyWXgdtypmiMEn',
            'RECAPTCHAV3_SECRET'=>'6LcabeAeAAAAANXGthvBOqaY5kEuky9Rn4V2V_m_',
            'fatoorah_base_url'=>'https://apitest.myfatoorah.com',
            'fatoorah_token'=>'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL
',
        ]);
    }

}
