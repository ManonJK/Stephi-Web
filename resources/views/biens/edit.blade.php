@extends('layouts.app')

@section('title', 'Ajouter un bien')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifier mon bien') }}</div>
                    <div class="card-body">
                        <form method="post" class="form" enctype="multipart/form-data" action="{{route('Biens.update', $bien->id)}}">
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

                            <div class="row">
                                <div class="col-6">
                                    <h3>Dépendances associées</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" data-toggle="modal" data-target="#add_dep" class="btn btn-outline-success">Ajouter une dépendance</button>
                                </div>
                            </div>
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Superficie</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bien->dependances as $dep)
                                    <tr>
                                        <td>{{$dep->nom}}</td>
                                        <td>{{$dep->pivot->superficie}}m²</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#edit_dep{{$dep->id}}" class="btn btn-warning">Modifier</button>
                                            <a href="{{url('Dependance/del/'.$bien->id.'/'.$dep->id)}}" type="button" class="btn btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <div class="row">
                                <div class="col-6">
                                    <h3>Photos</h3>
                                </div>
                                <div class="col-6">
                                    <button type="button" data-toggle="modal" data-target="#add_img" class="btn btn-outline-success">Ajouter une photo</button>
                                </div>
                            </div>
                            @foreach($bien->images as $image)
                                <div class="row">
                                    <div class="col">
                                        <img src="{{asset('storage/'.$image->lien)}}" alt="photo de la vente" class="photo-vente">
                                    </div>
                                    <div class="col d-flex flex-column align-items-start justify-content-center">
                                        <a href="{{url('Image/del/'.$image->id)}}" type="button" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </div>
                            @endforeach



                            <div class="form-group row">
                                <a type="button" href="/Home" class="btn btn-outline-secondary">Retour</a>
                                <button type="submit" class="btn btn-success">Valider</button>
                            </div>
                        </form>



                        <!-- Modal -->
                        <div class="modal fade" id="add_dep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" class="form" action="{{route('Dependance.create',$bien->id)}}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une dépendance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="type">Type :</label>
                                                <select name="type" id="type">
                                                    @foreach(App\Dependance::all() as $type)
                                                        <option value="{{$type->id}}">{{$type->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label for="superficie">Superficie :</label>
                                                <input type="number" id="superficie" class="form-control" name="superficie"/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    @foreach($bien->dependances as $dep)
                        <!-- Modal -->
                        <div class="modal fade" id="edit_dep{{$dep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" class="form" action="{{route('Dependance.update', ['id_bien' => $bien->id, 'id_dep'=>$dep->id])}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifier la dépendance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="type">Type :</label>
                                                <div class="alert alert-danger" role="alert">
                                                    Vous ne pouvez pas modifier le type de votre dépendance !
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="superficie">Superficie :</label>
                                                <input type="number" id="superficie" class="form-control" name="superficie" value="{{$dep->pivot->superficie}}"/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success">Valider les modifications</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <!-- Modal -->
                        <div class="modal fade" id="add_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" class="form" enctype="multipart/form-data" action="{{route('Image.store', ['id_bien'=>$bien->id])}}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une photo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="attachment">Photo (format jpg/jpeg) :</label>
                                                <input type="file" accept="image/jpeg" id="attachment" class="form-control" name="attachment" required/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success">Ajouter la photo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
