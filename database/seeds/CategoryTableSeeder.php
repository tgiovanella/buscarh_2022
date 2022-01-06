<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Outplacement',
                'slug' => Str::slug('Outplacement')
            ],
            [
                'id' => 2,
                'name' => 'Recrutamento e Seleção',
                'slug' => Str::slug('Recrutamento e Seleção')
            ],
            [
                'id' => 3,
                'name' => 'Coaching',
                'slug' => Str::slug('Coaching')
            ],
            [
                'id' => 4,
                'name' => 'Treinamento',
                'slug' => Str::slug('Treinamento')
            ],
            [
                'id' => 5,
                'name' => 'BPO',
                'slug' => Str::slug('BPO')
            ],
            [
                'id' => 6,
                'name' => 'Benefícios e Remuneração',
                'slug' => Str::slug('Benefícios e Remuneração')
            ],
            [
                'id' => 7,
                'name' => 'Comunicação Interna e Externa',
                'slug' => Str::slug('Comunicação Interna e Externa')
            ],
            [
                'id' => 8,
                'name' => 'Engagement / Clima Organizacional',
                'slug' => Str::slug('Engagement / Clima Organizacional')
            ],
            [
                'id' => 9,
                'name' => 'Folha de Pagamento e Ponto Eletrônico',
                'slug' => Str::slug('Folha de Pagamento e Ponto Eletrônico')
            ],
            [
                'id' => 11,
                'name' => 'Relações Trabalhistas',
                'slug' => Str::slug('Relações Trabalhistas')
            ],
            [
                'id' => 12,
                'name' => 'Gestão de Talentos',
                'slug' => Str::slug('Gestão de Talentos')
            ],
            [
                'id' => 13,
                'name' => 'HRIS',
                'slug' => Str::slug('HRIS')
            ],

        ]);

    }
}
