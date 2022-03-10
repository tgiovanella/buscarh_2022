<?php

use Illuminate\Database\Seeder;

class CoinsConfigurationTableSeeder extends Seeder
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
                'price_coins' => '89.9',
                'price_quote' => '50',
                'amount_coins' => '500',
                'email'=> 'thyhanry@hotmail.com'
            ]
        ]);
    }
}
