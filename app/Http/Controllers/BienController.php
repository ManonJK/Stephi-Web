<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Image;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biens = Bien::all();
        return view('biens.index', compact('biens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('biens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'=>'required',
            'localisation'=>'required',
            'superficie'=>'required',
            'etage'=>'required',
            'nb_pieces'=>'required',
            'descriptif'=>'required',
            'prix_min'=>'required',
            'prix_max'=>'required',
            'prix_vente'=>'required',
        ]);



        $bien = New Bien([
            'id_user'=>$request->user()->id,
            'id_type'=>Type::all()->where('titre', $request->get('type'))->first()->id,
            'localisation'=>$request->get('localisation'),
            'superficie'=>$request->get('superficie'),
            'etage'=>$request->get('etage'),
            'nb_pieces'=>$request->get('nb_pieces'),
            'descriptif'=>$request->get('descriptif'),
            'prix_min'=>$request->get('prix_min'),
            'prix_max'=>$request->get('prix_max'),
            'prix_vente'=>$request->get('prix_vente'),
        ]);
        $bien->save();


        if($request->hasFile('attachment'))
        {
            $message = 'image ok';
            foreach ($request->file('attachment') as $file) {
                $path = $file->storeAs('images',time().'.'.$file->extension(),'public');
                $link = time().'.'.$file->extension();
                $img = new Image([
                    'id_bien'=>$bien->id,
                    'lien'=>'images/'.$link,
                ]);
                $img->save();
            }
        } else{
            $message = 'pas image';
        }

        return redirect('/Home')->with('success', 'Votre bien a été créé avec succès !' . $message . public_path());
    }

    /**
     * Store a newly created resource in dependances.
     *
     * @param Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function create_dep(Request $request, $id){
        $data = $request->validate([
            'type'=>'required',
            'superficie'=>'required'
        ]);

        $bien = Bien::find($id);

        try {

            $bien->dependances()->attach($data['type'], ['superficie' => $data['superficie']]);
        } catch(QueryException $e){
            return back()->with('error', 'Une erreur s\'est produite, vous avez sûrement essayé d\'ajouter un doublon');
        }

        return back()->with('succes', 'Votre dépendance a été ajoutée avec succès!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function show(Bien $bien)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  array $data
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, array $data, Bien $bien)
    {
        $data = $request->validate([
            'location'=>'string',
            'prix_min'=>'int',
            'prix_max'=>'int',
            'nb_pieces'=>'int',
            'type'=>'int'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('biens.edit', ['bien' => Bien::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'localisation'=>'required',
            'superficie'=>'required',
            'etage'=>'required',
            'nb_pieces'=>'required',
            'descriptif'=>'required',
            'prix_min'=>'required',
            'prix_max'=>'required',
            'prix_vente'=>'required',
        ]);

        $bien = Bien::where('id', $id);
        $bien->update($data);
//
//        $bien->fill($data);
//        $bien->save();

        return redirect('/Home')->with('success', 'Mise à jour de votre bien effectuée avec succès !');
    }

    public function update_dep(Request $request, $id_bien, $id_dep){

        $data = $request->validate([
            'superficie'=>'required',
        ]);

        $bien = Bien::find($id_bien);
        $bien->dependances()->updateExistingPivot($id_dep, $data);
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bien  $bien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bien $bien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id_bien
     * @param $id_dep
     * @return \Illuminate\Http\Response
     */
    public function destroy_dep($id_bien, $id_dep)
    {
        $bien = Bien::find($id_bien);
        $bien->dependances()->detach($id_dep);
        return back();
    }
}
