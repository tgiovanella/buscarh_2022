<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = array_values(App\Subcategory::select('id')->get()->toArray());
        factory(App\Company::class, 1000)->create()->each(function ($c) use ($subcategories) {
            $c->save();
            $rand = array_filter(array_rand($subcategories,10), function ($i) { return $i !== 0; });
            $c->subcategories()->attach($rand);
        });
    }
}
