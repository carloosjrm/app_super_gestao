<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            /* $contato = new SiteContato();
             $contato->nome= 'Sistema SG';
             $contato->telefone= '(11) 98889-9988';
             $contato->email= 'contato@sg.com.br';
             $contato->motivo_contato=1;
             $contato->mensagem = 'Seja Bem vindo ao sistema Super Gestão';
             $contato->save();
            */
            \App\Models\SiteContato::factory(100)->create();
    }
}
