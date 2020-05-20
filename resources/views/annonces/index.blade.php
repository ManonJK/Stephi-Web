@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <div class="d-flex flex-row flex-wrap align-items-start justify-content-center">
            @foreach($annonces as $annonce)
                <div class="card">
                    <a href="{{ url('Annonces/'.$annonce->id) }}">
                        <img src="{{asset('storage/'.$annonce->bien->images[0]->lien.'.jpg')}}" class="card-img-top" alt="image de l'annonce">
                        <div class="card-body">
                            <h5 class="card-title">{{$annonce->bien->type->titre}} {{$annonce->bien->superficie}} m² - {{$annonce->bien->prix_vente}}€</h5>
                            <p class="card-text">
                                @if(strlen($annonce->bien->descriptif)>136)
                                    {{$description = substr_replace($annonce->bien->descriptif, '...', 133)}}
                                @else
                                    {{$description = $annonce->bien->descriptif}}
                                @endif
    {{--                            {{$description ?? $annonce->bien->descriptif}}--}}
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{$annonce->bien->localisation}}</small>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="d-flex flex-row">{{$annonces->links()}}</div>
    </div>
@endsection
