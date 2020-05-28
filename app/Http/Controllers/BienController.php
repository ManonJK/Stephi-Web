<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Image;
use App\Type;
use App\User;
use Illuminate\Http\Request;

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

        $files = $request->file('attachment');

        if($request->hasFile('attachment'))
        {
            foreach ($files as $file) {
                $file->store('storage/app/public/images/' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension());
                $link = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
                $img = new Image([
                    'id_bien'=>$request->user()->id,
                    'lien'=>$link,
                ]);
                $img->save();
            }
        }

        return redirect('/Home')->with('success', 'Votre bien a été créé avec succès !');
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
    public function update(Request $request, Bien $bien)
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

        $bien->fill($data);
        $bien->save();

        return redirect('Home')->with('success', 'Mise à jour de votre bien effectuée avec succès !');
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
}
