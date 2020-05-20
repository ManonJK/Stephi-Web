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

        function get_simulation(){
            let vente = {!! json_encode($vente->bien->toArray(), JSON_HEX_TAG) !!};
            let mn_prix = vente['prix_min'];
            let mx_prix = vente['prix_max'];
            let prix = document.getElementById('prix_sim').value;
            let res;
            if (prix < mn_prix){
                res = 'Votre offre doit être supérieure ou égale à la demande du vendeur';
            } else if (prix > mx_prix){
                console.log(vente['prix_max']);
                res = 'Vos chances d\'obtenir ce bien pour votre prix sont de 100% !'
            }
            else{
                let simu = Math.floor(Math.random() * Math.floor(101));
                res = "Vos chances d'obtenir ce bien pour votre prix sont de " + simu + "% !";
            }
            document.getElementById("simulation").innerHTML=res;
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                @foreach($vente->bien->images as $image)
                    <img src="{{asset('storage/'.$image->lien.'.jpg')}}" alt="photo de la vente" class="photo-vente">
                @endforeach
            </div>
            <div class="col-md-auto">
                <div class="d-flex flex-column description_vente">
                    <h1>{{$vente->bien->type->titre}} {{$vente->bien->superficie}} m² - {{$vente->bien->prix_vente}}€</h1>
                    <p class="text-muted">{{$vente->bien->localisation}}</p>
                    <span class="d-inline-block">Description :</span>
                    <span class="d-inline-block">{{$vente->bien->descriptif}}</span>
                    <span>Prix minimum souhaité : {{$vente->bien->prix_min}}€</span>

                    <form id="form">
                        <label>Calculer mes chances d'obtenir ce bien pour le prix de :</label>
                        <div class="d-flex flex-row justify-content-start">
                            <div class="input-box">
                                <label id="simprix" class="input-label">Prix (€)</label>
                                <input id="prix_sim" name="prix_sim" required type="number" min="{{$vente->bien->prix_min}}" max="{{$vente->bien->prix_max}}" class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                            </div>
                            <button type="button" onclick="get_simulation()" class="btn btn_offre btn-primary pull-right">Simuler mon offre</button>
                            <div class="clear"></div>

                        </div>
                    </form>
                    <div id="simulation"></div>

                </div>
            </div>
        </div>
    </div>

@endsection
