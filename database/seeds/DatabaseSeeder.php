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

        $myagent = New App\Agent([
            'nom' => 'JK',
            'prenom' => 'Manon',
            'phone' => Hash::make('0626103528'),
            'email' => 'manon@gmail.com',
            'password' => Hash::make('totototo'),
            'id_agence' => '1',
        ]);
        $myagent->save();




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

        $my_client = New App\User([
            'nom' => 'Totoute',
            'prenom' => 'Biloute',
            'phone' => Hash::make('0601020304'),
            'birth_date' => '1994-12-25',
            'email' => 'toto@gmail.com',
            'password' => Hash::make('totototo'),
            'id_agent' => 31,
        ]);
        $my_client->save();

        $myfirstestate = New \App\Bien([
            'superficie' => 600,
            'nb_pieces' => 14,
            'etage' => 2,
            'localisation' => 'Aix-en-Provence',
            'descriptif' => 'Mon imaginaire est vraiment cool, il a plein de trucs dont une piscine. Vous devriez acheter !',
            'prix_min' => 100000,
            'prix_max' => 900000,
            'prix_vente' => 666666,
            'id_user' => 201,
            'id_type' => 3,
        ]);
        $myfirstestate->save();



    }
}
