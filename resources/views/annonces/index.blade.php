@extends('layouts.app')

@section('content')
    <script>
        function setFocus(on) {
            let element = document.activeElement;
            if (on) {
                setTimeout(function () {
                    element.parentNode.classList.add("focus");
                });
            } else {
                let box = document.querySelector(".input-box");
                box.classList.remove("focus");
                $("input").each(function () {
                    let $input = $(this);
                    let $parent = $input.closest(".input-box");
                    if ($input.val()) $parent.addClass("focus");
                    else $parent.removeClass("focus");
                });
            }
        }
    </script>


    <div class="d-flex flex-column align-items-center">

{{--        Ici de quoi filtrer les biens--}}
        <form class="d-flex flex-column align-items-center w-100" action="">
            <div class="d-flex flex-row justify-content-start">
                <div class="input-box">
                    <label class="input-label">Localisation</label>
                    <input id="location" required type="text" maxlength="30" class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                </div>
                <div class="input-box">
                    <label class="input-label">Prix min(€)</label>
                    <input id="prix_min" required type="number"  class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                </div>
                <div class="input-box">
                    <label class="input-label">Prix max(€)</label>
                    <input id="prix_max" required type="number" class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                </div>
                <div class="input-box">
                    <label class="input-label">Nombre de pièces</label>
                    <input id="nb_pieces" required type="number" class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                </div>
                <select name="types" id="type-select">
                    <option value="">--Type--</option>
                    @foreach(App\Type::all() as $type)
                    <option value="{{$type->titre}}">{{$type->titre}}</option>
                    @endforeach
                </select>
{{--                <select name="places" id="place-select">--}}
{{--                    <option value="">--Localisation--</option>--}}
{{--                    @foreach(App\Bien::distinct('localistion') as $bien)--}}
{{--                        <option value="{{$bien->localisation}}">{{$bien->localisation}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
                <button type="button" class="btn btn_offre btn-primary pull-right">Chercher</button>
                <div class="clear"></div>

            </div>
        </form>



        <div class="d-flex flex-row flex-wrap align-items-start justify-content-center">
            @foreach($annonces as $annonce)
                <div class="card card-annonce">
                    <a href="{{ url('Annonces/'.$annonce->id) }}">
                        <img src="{{asset('storage/'.$annonce->bien->images[0]->lien.'.jpg')}}" class="card-img-top card-img-top-annonce" alt="image de l'annonce">
                        <div class="card-body card-annonce-body">
                            <h5 class="card-title">{{$annonce->bien->type->titre}} {{$annonce->bien->superficie}} m² - {{$annonce->bien->prix_vente}}€</h5>
                            <p class="card-text">
                                @if(strlen($annonce->bien->descriptif)>136)
                                    {{$description = substr_replace($annonce->bien->descriptif, '...', 133)}}
                                @else
                                    {{$description = $annonce->bien->descriptif}}
                                @endif
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
