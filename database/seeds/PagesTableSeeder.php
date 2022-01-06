<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pages')->insert([
            //pagina
            [

                'title' => 'Quem somos',
                'slug' => Str::slug('Quem somos'),
                'body' => '<p>Somos uma empresa que ajuda as pessoas e áreas de RH a encontrarem, de maneira organizada, rápida e efetiva, as consultorias e prestadores de serviço de RH ideais para suprirem a necessidade que tiverem.<p>
                           <p>Nossa tecnologia e nossa paixão por ajudar os outros aproximam quem precisa de um determinado serviço, de qualquer subsistema de RH, e alavancam exponencialmente a visibilidade, crescimento e abrangência de atuação das consultorias de RH em todo Brasil.</p>
                           <h2>Visão</h2>
                           <p>Ser o <strong>melhor site de buscas de serviços de RH</strong> do Brasil</p>
                           <h2>Missão</h2>
                           <p>Gerar <strong>economia de tempo</strong> e mais <strong>efetividade nas buscas</strong> de serviço de qualquer subsistema de RH e alavancar exponencialmente a <strong>visibilidade, crescimento e abrangência</strong> de atuação das <strong>consultorias de RH</strong> em todo Brasil.</p>
                           <h2>Valores</h2>
                           <p>Ser o <strong>melhor site de buscas de serviços de RH</strong> do Brasil</p>'

            ],

            //pagina
            [

                'title' => 'Privacidade',
                'slug' => Str::slug('privacidade'),
                'body' => '<p>Conteúdo em construção...</p>'

            ]
        ]);

        //blocos para o menu
        \DB::table('page_blocks')->insert([
            //menu principal
            [
                'id' => 1,
                'name' => 'Principal',
                'slug' => 'principal',
            ],
            [
                'id' => 2,
                'name' => 'Rodapé',
                'slug' => 'rodape',
            ],
        ]);

        \DB::table('page_navs')->insert([
            //menu principal
            [
                'name' => 'Quem somos',
                'slug' => Str::slug('Quem somos'),
                'page_block_id' => 1,
                'url' => 'institucional/quem-somos',
                'order' => 1,
            ],
            [
                'name' => 'FAQ',
                'slug' => Str::slug('FAQ'),
                'page_block_id' => 1,
                'url' => 'faq',
                'order' => 2,
            ],
            [
                'name' => 'Privacidade',
                'slug' => Str::slug('Privacidade'),
                'page_block_id' => 1,
                'url' => 'institucional/privacidade',
                'order' => 3,
            ],


            //menu rodapé
            [

                'name' => 'Inicial',
                'slug' => Str::slug('home'),
                'page_block_id' => 2,
                'url' => '',
                'order' => 1,
            ],
            [

                'name' => 'Quem somos',
                'slug' => Str::slug('Quem somos'),
                'page_block_id' => 2,
                'url' => 'institucional/quem-somos',
                'order' => 2,
            ],
            [
                'name' => 'FAQ',
                'slug' => Str::slug('FAQ'),
                'page_block_id' => 2,
                'url' => 'faq',
                'order' => 3,
            ],
            [
                'name' => 'Privacidade',
                'slug' => Str::slug('Privacidade'),
                'page_block_id' => 2,
                'url' => 'institucional/privacidade',
                'order' => 4,
            ],
            [
                'name' => 'Fale Conosco',
                'slug' => Str::slug('Fale Conosco'),
                'page_block_id' => 2,
                'url' => 'contato',
                'order' => 5,
            ],
            [
                'name' => 'Anuncie',
                'slug' => Str::slug('Fale Conosco'),
                'page_block_id' => 2,
                'url' => 'anuncie',
                'order' => 6,
            ],

            [
                'name' => 'Denunciar Anúncio',
                'slug' => Str::slug('Denunciar Anúncio'),
                'page_block_id' => 2,
                'url' => 'denunciar-anuncio',
                'order' => 7,
            ],

            [
                'name' => 'Reivindicar sua ficha da empresa',
                'slug' => Str::slug('reivindicar-empresa'),
                'page_block_id' => 2,
                'url' => 'reivindicar-empresa',
                'order' => 8,
            ],



        ]);
    }
}
