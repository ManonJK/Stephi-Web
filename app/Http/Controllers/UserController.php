<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Mail\OffreMail;
use App\User;
use App\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->archive=true;
        $user->save();
        Auth::logout();
        return redirect('/')->with('success', 'Votre compte a été supprimé avec succès');
    }


    /**
     * Send an email offer to the seller
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $id_seller
     * @param $id_sale
     * @return \Illuminate\Http\Response
     */
    public function send_offer_email(Request $request, $id_sale, $id_seller){

        $request->validate([
            'prix'=>'required',
        ]);

        $estate = Vente::find($id_sale)->bien;
        $seller_email = User::find($id_seller)->email;
        $agent_email = User::find($id_seller)->agent->email;
        Mail::to($seller_email)
            ->cc($agent_email)
            ->send(new OffreMail($request->user(), $request->get('prix'), $estate));
        return back()->with('success', 'Votre proposition d\'achat a bien été envoyé au vendeur du bien');
    }
}
