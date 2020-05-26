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
