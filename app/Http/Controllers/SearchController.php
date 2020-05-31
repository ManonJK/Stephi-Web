<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vente;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function filter(Request $request, Vente $annonces){
        $annonces = $annonces->newQuery()->where('status', '=', 'En cours');

        if (!empty($request->input('location'))) {
            $annonces->whereHas('bien', function ($query) use ($request) {
                $query->where('biens.localisation', [$request->input('location')]);
            });
        }

        if (!empty($request->input('types'))) {
            $annonces->whereHas('bien', function ($query) use ($request) {
                $query->where('biens.id_type', [$request->input('types')]);
            });
        }

        if (!empty($request->input('prix_min'))) {
            $annonces->whereHas('bien', function ($query) use ($request) {
                $query->where('biens.prix_min', '>=', [$request->input('prix_min')]);
            });
        }

        if (!empty($request->input('prix_max'))) {
            $annonces->whereHas('bien', function ($query) use ($request) {
                $query->where('biens.prix_max', '<=', [$request->input('prix_max')]);
            });
        }

        if (!empty($request->input('nb_pieces'))) {
            $annonces->whereHas('bien', function ($query) use ($request) {
                $query->where('biens.nb_pieces', [$request->input('nb_pieces')]);
            });
        }

        // Get the results and return them.
//        return $annonces->get();
//        $annonces = $annonces->paginate(15);
        return view('annonces.index')->with('annonces', $annonces->paginate(15));
    }
}
