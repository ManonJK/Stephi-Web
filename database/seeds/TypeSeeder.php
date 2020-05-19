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
            ['titre' => 'maison'],
            ['titre' => 'appartement'],
            ['titre' => 'villa'],
            ['titre' => 'studio']
        ];

        App\Type::insert($array);
    }
}
