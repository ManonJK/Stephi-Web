@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col align-items-center">
       <h1>Dashboard {{Auth::user()->nom}} {{Auth::user()->prenom}}</h1>
        <br>
        <div class="row">
            <div class="col-6 col-sm-2">
                <h3>Mes biens</h3>
            </div>
            <div class="col-6 col-sm-2">
                <a href="{{ url('Biens/create') }}" class="btn btn-outline-success">Ajouter un bien</a>
            </div>
        </div>
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Superficie</th>
                <th scope="col">Localisation</th>
                <th scope="col">Status</th>
                <th scope="col">Mis en favoris</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($biens as $bien)
                @if($bien->vente)
                @switch($bien->vente->status)
                    @case('En cours')
                    <tr class="table-info">
                    @break
                    @case('Annulée')
                    <tr class="table-danger">
                    @break
                    @case('Vendu')
                    <tr class="table-success">
                    @break
                @endswitch
                        <td>{{$bien->type->titre}}</td>
                        <td>{{$bien->superficie}}m²</td>
                        <td>{{$bien->localisation}}</td>
                        <td>{{$bien->vente->status}}</td>
                        <td>{{$bien->favoris->count()}} fois</td>
                        @if($bien->vente->status==='En cours')
                            <td>
                                <a href="{{url('Biens/edit/'.$bien->id)}}" type="button" class="btn btn-warning">Modifier</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel_sale{{$bien->vente->id}}">Annuler la vente</button>
                            </td>
                            @else
                            <td></td>
                        @endif
                    </tr>
                    @endif
            @endforeach
            </tbody>
        </table>
        <br>
        <h3>Mes favoris</h3>
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Superficie</th>
                <th scope="col">Localisation</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($favoris as $favori)
                @switch($favori->bien->vente->status)
                    @case('En cours')
                    <tr class="table-info">
                    @break
                    @case('Annulée')
                    <tr class="table-danger">
                    @break
                    @case('Vendu')
                    <tr class="table-success">
                        @break
                        @endswitch
                        <td>{{$favori->bien->type->titre}}</td>
                        <td>{{$favori->bien->superficie}}m²</td>
                        <td>{{$favori->bien->localisation}}</td>
                        <td>{{$favori->bien->vente->status}}</td>
                        <td>
                        @if($favori->bien->vente->status==='En cours')
                                <a href="{{ url('Annonces/'.$favori->bien->vente->id) }}" type="button" class="btn btn-info">Voir le bien</a>
                        @endif

                            <a href="{{url('Favoris/del/'.$favori->id_bien)}}" type="button" class="btn btn-danger">Supprimer des favoris</a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>


        @foreach($biens as $bien)
        <!-- Modal annulation de vente-->
        <div class="modal fade" id="cancel_sale{{$bien->vente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Annuler la vente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes vous sûr(e) de vouloir annuler la vente de ce bien ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Non, revenir en arrière</button>
                        <a href="{{url('Annonces/cancel/'.$bien->vente->id)}}" type="button" class="btn btn-danger">Annuler la vente</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection
