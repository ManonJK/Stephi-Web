<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \http\Env\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return view('users.show', compact( 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email',
        ]);

        $user->fill($data);
        $user->save();
//        Flash::message('Mise à jour de votre profil effectuée avec succès !');

        return back()->with('success', 'Mise à jour de votre profil effectuée avec succès !');
    }


    /**
     * Update the phone number specifically of the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_phone (Request $request, User $user)
    {
        $data = $request->validate([
            'old-phone'=>'required',
            'phone'=>'required',
            'phone-confirm'=>'required|email',
        ]);

        $new_phone = $data['phone'];

        if (Hash::check($data['old-phone'], $user->password && $data['phone'] == $data['phone-confirm'])) {
//            // The passwords match...
//            $user->fill($new_phone);
//            $user->save();
            return back()->with('success', 'Mise à jour de votre profil effectuée avec succès !');
        }else{
            return back()->with('error', 'Votre numéro de téléphone n\'a pas pu être modifié. Veuillez vérifier les informations et réessayer.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
