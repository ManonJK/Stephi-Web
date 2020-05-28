@extends('layouts.app')

@section('title', 'Ajouter un bien')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Nouveau bien') }}</div>
                    <div class="card-body">
                        <form method="post" class="form" action="{{route('Biens.store')}}">
                            @csrf
                            <div class="form-group row">
                                <span class="required">* Champs obligatoires</span>
                            </div>
                            <div class="form-group row">
                                <label for="type">Type :<span class="required"> *</span></label>
                                <select name="type" id="type" required>
                                    @foreach(App\Type::all() as $type)
                                        <option value="{{$type->titre}}">{{$type->titre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="localisation">Localisation :<span class="required"> *</span></label>
                                <input type="text" id="localisation" class="form-control" name="localisation" required/>
                            </div>
                            <div class="form-group row">
                                <label for="superficie">Superficie :<span class="required"> *</span></label>
                                <input type="number" id="superficie" class="form-control" name="superficie" required/>
                            </div>
                            <div class="form-group row">
                                <label for="etage">Etage :<span class="required"> *</span></label>
                                <input type="number" id="etage" class="form-control" name="etage" required/>
                            </div>
                            <div class="form-group row">
                                <label for="nb_pieces">Nombre de pièces :<span class="required"> *</span></label>
                                <input type="number" id="nb_pieces" class="form-control" name="nb_pieces" required/>
                            </div>
                            <div class="form-group row">
                                <label for="descriptif">Description :<span class="required"> *</span></label>
                                <input type="text" id="descriptif" class="form-control" name="descriptif" required/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_min">Prix minimum souhaité :<span class="required"> *</span></label>
                                <input type="number" id="prix_min" class="form-control" name="prix_min" required/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_max">Prix maximum souhaité :<span class="required"> *</span></label>
                                <input type="number" id="prix_max" class="form-control" name="prix_max" required/>
                            </div>
                            <div class="form-group row">
                                <label for="prix_vente">Prix de vente souhaité :<span class="required"> *</span></label>
                                <input type="number" id="prix_vente" class="form-control" name="prix_vente" required/>
                            </div>
                            <div class="form-group row">
                                <label for="attachment">Photos (format jpg/jpeg) :</label>
                                <input type="file" accept="image/jpeg" multiple id="attachment" class="form-control" name="attachment[]"/>
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
