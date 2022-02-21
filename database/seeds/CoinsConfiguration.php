<?php

use Illuminate\Database\Seeder;

class CandidateBuyCoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('coins_configuration')->insert([
            [
                'id' => 1,
                'price_coins' => 59.90,
                'price_quote' => 80,
                'amount_coins' => 500
            ]
        ]);
    }
}
