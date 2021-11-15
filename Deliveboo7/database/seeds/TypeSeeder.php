<?php

use Illuminate\Database\Seeder;
use App\Type;


class TypeSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    if(DB::table('types')->count() == 0){
        DB::table('types')->insert([
            [
                'nome' => 'Italiano',
            ],
            [
                'nome' => 'Regionale',
            ],
            [
                'nome' => 'Giapponese',
            ],
            [
                'nome' => 'Thailandese',
            ],
            [
                'nome' => 'Messicano',
            ],
            [
                'nome' => 'Greco',
            ],
            [
                'nome' => 'Arabo',
            ],
            [
                'nome' => 'Cinese',
            ],
            [
                'nome' => 'Fusion',
            ],
            [
                'nome' => 'Pizza',
            ],
            [
                'nome' => 'Pesce',
            ],
            [
                'nome' => 'Altro',
            ]

        ]);
    } else { echo "\e[31mTable is not empty, therefore NOT "; }
  }
}
