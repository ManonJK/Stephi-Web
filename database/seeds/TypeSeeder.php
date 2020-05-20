<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['titre' => 'Maison'],
            ['titre' => 'Appartement'],
            ['titre' => 'Villa'],
            ['titre' => 'Studio']
        ];

        App\Type::insert($array);
    }
}
