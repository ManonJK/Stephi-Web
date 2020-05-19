<?php

use Illuminate\Database\Seeder;

class DependanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['nom'=>'cave'],
            ['nom'=>'jardin'],
            ['nom'=>'parking'],
            ['nom'=>'garage'],
            ['nom'=>'studio'],
        ];

        App\Dependance::insert($array);
    }
}
