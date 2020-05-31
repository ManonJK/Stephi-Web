@component('mail::message')
# Proposition d'achat tarifée

L'utilisateur {{$customer->prenom}} {{$customer->nom}} vous fait une proposition pour votre {{$estate->type->titre}} situé(e) à {{$estate->localisation}} d'une superficie de {{$estate->superficie}}m².
Le montant de cette proposition est de {{$prix}}€.

Vous pouvez communiquer avec cet acheteur en lui envoyant un mail à {{$customer->email}}.

*Cet email a été transféré à l'agent chargé de la vente.*



*Cet email a été envoyé automatiquement, merci de ne pas y répondre.*

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
