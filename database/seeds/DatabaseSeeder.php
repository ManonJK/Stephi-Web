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
        $this->call(TypeSeeder::class);

        $this->call(DependanceSeeder::class);

        factory(App\Agence::class, 10)->create();
        $agences = App\Agence::all();
        factory(App\Agent::class, 30)->create()->each(function($agent) use ($agences){
            $agent->agence()->associate($agences->random());
            $agent->save();
        });


        factory(App\User::class, 200)->create();


        $dependances = App\Dependance::all();
        $users = App\User::all();
        $types = App\Type::all();


        factory(App\Bien::class, 100)->create()->each(function ($bien) use ($dependances, $agences, $users, $types){
            // Génère la relation entre le bien et ses dependences
            $dependenciesCount = random_int(0, $dependances->count());
            if($dependenciesCount !== 0){
                $biens_dependances = $dependances->random($dependenciesCount);
                foreach($biens_dependances as $dep){
                    $bien->dependances()->attach($dep, ['superficie' => random_int(20, 200)]);
                }
            }

            $type = $types->random();
            $bien->type()->associate($type);

            // Génère la relation entre le bien et son agence
            $agency = $agences->random();
            // Génère la relation entre le bien et son vendeur
            $member = $users->random();
            $bien->user()->associate($member);
            // Assigne au vendeur un agent aléatoire de l'agence du bien
            $member->agent()->associate(App\Agent::where('id_agence', $agency->id)->get()->random());
            $bien->save();
            $member->save();
        });

        $ventes = factory(App\Vente::class, 100)->create();
        for ($i = 0; $i<sizeof($ventes); $i++){
            $ventes[$i]->id_bien = $i+1;
            $ventes[$i]->save();
        }

        $images = factory(App\Image::class, 100)->create();
        for ($i = 0; $i<sizeof($images); $i++){
            $images[$i]->id_bien = $i+1;
            $images[$i]->save();
        }
    }
}
