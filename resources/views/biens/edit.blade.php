@extends('layouts.app')

@section('title', 'Ajouter un bien')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifier mon bien') }}</div>
                    <div class="card-body">
                        <form method="put" class="form" action="{{route('Biens.update', $bien)}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="type">Type :</label>
                                <div class="alert alert-danger" role="alert">
                                    Vous ne pouvez pas modifier le type de votre bien !
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="localisation">Localisation :</label>
                                <input type="text" id="localisation" class="form-control" name="localisation" value="{{$bien->localisation}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="superficie">Superficie :</label>
                                <input type="number" id="superficie" class="form-control" name="superficie" value="{{$bien->superficie}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="etage">Etage :</label>
                                <input type="number" id="etage" class="form-control" name="etage" value="{{$bien->etage}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="nb_pieces">Nombre de pièces :</label>
                                <input type="number" id="nb_pieces" class="form-control" name="nb_pieces" value="{{$bien->nb_pieces}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="descriptif">Description :</label>
                                <input type="text" id="descriptif" class="form-control" name="descriptif" value="{{$bien->descriptif}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_min">Prix minimum souhaité :</label>
                                <input type="number" id="prix_min" class="form-control" name="prix_min" value="{{$bien->prix_min}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_max">Prix maximum souhaité :</label>
                                <input type="number" id="prix_max" class="form-control" name="prix_max" value="{{$bien->prix_max}}"/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_vente">Prix de vente souhaité :</label>
                                <input type="number" id="prix_vente" class="form-control" name="prix_vente" value="{{$bien->prix_vente}}"/>
                            </div>
                            <div class="form-group row">
                                <button type="submit" class="btn btn-success">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
