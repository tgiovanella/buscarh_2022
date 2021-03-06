<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SubcategoryTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CoinsConfigurationTableSeeder::class);

        //atualiza os seeds
        $this->call(UpdateSlugCompanySeeder::class); //UpdateSlugCompanySeeder

    }
}
