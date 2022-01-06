<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert([
            [
                'id' => 1,
                'name' => 'Matheus Flauzino',
                'email' => 'matheusantonioflauzino@gmail.com',
                'password' => '$2y$10$HCbzoguu14.xRUBXsWgWxuQ53d0MXRf/bDjGIv33.hztGZN4auLXS'
            ],
            [
                'id' => 2,
                'name' => 'Thiago Giovanella',
                'email' => 'thiago.giovanella@ezdigital.tech',
                'password' => bcrypt('thi@2019#')
            ],
            [
                'id' => 3,
                'name' => 'Marcelo',
                'email' => 'marcelodpn@gmail.com',
                'password' => bcrypt('mar@2019#')
            ]



        ]);

        \DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Matheus Flauzino',
                'email' => 'matheusantonioflauzino@gmail.com',
                'password' => '$2y$10$HCbzoguu14.xRUBXsWgWxuQ53d0MXRf/bDjGIv33.hztGZN4auLXS'
            ],
            [
                'id' => 2,
                'name' => 'Thiago Giovanella',
                'email' => 'thiago.giovanella@ezdigital.tech',
                'password' => bcrypt('thi@2019#')
            ],
            [
                'id' => 3,
                'name' => 'Marcelo',
                'email' => 'marcelodpn@gmail.com',
                'password' => bcrypt('mar@2019#')
            ]
        ]);
    }
}
