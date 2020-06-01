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



                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 90vh;">
                    <ol class="carousel-indicators">
                        @for($i=0; $i<$vente->bien->images->count(); $i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"
                            @if($i===0)
                            class="active"
                            @endif
                            ></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        <?php $a = 0; ?>
                        @foreach($vente->bien->images as $image)
                            <div
                                @if($a === 0)
                                    class="carousel-item active">
                                @else
                                    class="carousel-item">
                                @endif
                                <img src="{{asset('storage/'.$image->lien)}}" class="d-block w-100" alt="Photo de la vente">
                            </div>
                            <?php $a++; ?>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
            <div class="col">
                <div class="d-flex flex-column description_vente">
                    <div class="row">
                        <div class="col">
                            <h1>{{$vente->bien->type->titre}} {{$vente->bien->superficie}} m² - {{$vente->bien->prix_vente}}€</h1>
                        </div>
                        <div class="col">
                            @if($vente->status === 'En cours')
                                @auth
                                    @if($vente->bien->id_user !== Auth::user()->id)

                {{--                    On vérifie si le bien est déjà en favori ou non--}}

                                        @if(!Auth::user()->favoris->where('id_bien',$vente->bien->id)->isEmpty())
                {{--                            N'est pas vide--}}
                                            <a href="{{url('Favoris/del/'.$vente->bien->id)}}"><i class="fas fa-heart"></i></a>
                                        @else
                {{--                            Est vide--}}
                                            <a href="{{url('Favoris/Store/'.$vente->bien->id)}}"><i class="far fa-heart"></i></a>
                                        @endif

                                    @endif

                                @endauth
                            @elseif ($vente->bien->id_user === Auth::user()->id)
                            @else
                                <h2><span class="badge badge-danger">Cette vente a été effectuée ou annulée</span></h2>
                            @endif
                        </div>
                    </div>
                    <p class="text-muted">{{$vente->bien->localisation}}</p>
                    <span class="d-inline-block">Description :</span>
                    <p class="text-wrap">{{$vente->bien->descriptif}}</p>

                    @if(! $vente->bien->dependances->isEmpty())
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Dépendances associées :
                        </div>
                        <ul class="">
                            @foreach($vente->bien->dependances as $dep)
                                <li class="">{{$dep->nom}} : {{$dep->pivot->superficie}}m²</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <span>Prix minimum souhaité : {{$vente->bien->prix_min}}€</span>
                    <span>Frais d'agence : {{$vente->bien->user->agent->agence->frais_agence}}%</span>


                    @if($vente->status === 'En cours')
                        @if(Auth::user() && $vente->bien->id_user !== Auth::user()->id || !Auth::user())
                            <form id="form">
                                <label>Calculer mes chances d'obtenir ce bien pour le prix de :</label>
                                <div class="d-flex flex-row justify-content-start">
                                    <div class="input-box">
                                        <label id="simprix" for="prix_sim" class="input-label">Prix (€)</label>
                                        <input id="prix_sim" name="prix_sim" required type="number" min="{{$vente->bien->prix_min}}" max="{{$vente->bien->prix_max}}" class="input-1" onfocus="setFocus(true)" onblur="setFocus(false)" />
                                    </div>
                                    <button type="button" onclick="get_simulation()" class="btn btn_offre btn-primary pull-right">Simuler mon offre</button>
                                    <div class="clear"></div>

                                </div>
                            </form>
                            <div id="simulation"></div>

                                @if(Auth::user())
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#achat">
                                        Faire une proposition d'achat tarifée
                                    </button>
                                @else
                                    <a href="{{url('/login')}}" class="btn btn-success">Faire une proposition d'achat tarifée</a>
                                @endif
                        @else
                            <p class="text-wrap text-muted">Ceci est votre bien. Vous ne pouvez pas faire de proposition d'achat ou simuler vos chances d'achat</p>
                        @endif



                        <!-- Modal -->
                            <div class="modal fade" id="achat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" class="form" enctype="multipart/form-data" action="{{route('Mail.send', ['id_sale'=>$vente->id, 'id_seller'=>$vente->bien->id_user])}}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Faire une proposition d'achat tarifée</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="prix">Prix :</label>
                                                    <input type="number" id="prix" class="form-control" name="prix"/>
                                                </div>
                                                <p class="text-muted font-italic">En validant, vous enverrez un mail au vendeur avec vos informations personnnelles (email, nom, prénom)</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-success">Envoyer la proposition</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
