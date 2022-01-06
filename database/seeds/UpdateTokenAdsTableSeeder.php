<?php

use Illuminate\Database\Seeder;

class UpdateTokenAdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=UpdateTokenAdsTableSeeder
     * @return void
     */
    public function run()
    {

        $ads = App\Advert::all();

        foreach ($ads as $ad) {
            if ($ad->token_id == null) {
                $ad->token_id = md5(uniqid(rand(), true));
                $ad->save();
            }
        }
    }
}
