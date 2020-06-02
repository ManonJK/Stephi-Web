# Stephi Place Web Sales 

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## A propos du projet

Ce projet a été réalisé en collaboration avec SEGUIN Ghislain dans le cadre de notre 2ème année de bachelor informatique.
Ce projet a été développé avec le framework Laravel

## Sujet du projet

> Equiper la société Stephi Place Real Estate et l’accompagner dans son développement national

Stephi Place Real Estate est un réseau d’agences immobilières britannique. Dirigé par la très médiatique Stephi Place, star de la téléréalité (I want to sell my house, Houses hunter’s, Looking for my appartment), Stephi Place Real Estate est implantée en France dont le siège est situé à Aix en Provence.
L’entreprise compte développer rapidement un réseau d’agences sur l’ensemble du territoire national. Le réseau est constitué d’environ 50 agences réparties sur la France entière. Chaque agence possède sa propre connexion à internet.

### Spécification web

La société Stephi Place Real Estate souhaite développer un site Web de gestion de vente de biens immobiliers : Stephi Place Web Sales.

Ce site doit être accessible pour tout public. Les fonctionnalités avancées sont accessibles pour tout utilisateur authentifié, et doit permettre plusieurs fonctionnalités, notamment l’ajout d’un bien immobilier, l’ajout d’un client, aussi bien vendeur qu’acheteur potentiel, la modification des informations du client, la réalisation d‘une vente, la gestion des favoris, la gestion des proposition …

Un bien immobilier peut être aussi bien un appartement qu’une villa, est décrit par son type, sa superficie, le nombre de pièces, l’étage dans le cas d’un appartement, sa localisation, un descriptif, les dépendances associées (jardin, cave, loggia, cellier, terrasse, garage, ...) et leurs superficies, le prix de vente minimum souhaité, le prix de vente maximum, le prix de mise en vente, ainsi que les frais d’agence.

Les biens sont mis en vente par le client d’une agence, chaque agence possède donc des biens à vendre. L’ensemble des biens à vendre de chaque agence est visible sur le site du siège au niveau national.
Un acheteur potentiel, nommé client final, peut s’inscrire sur le site, à condition qu’il dispose d’une adresse mail valide qui lui servira d’identifiant et en renseignant une série d’informations personnelles telles que son nom, prénom, adresse, numéro de téléphone mobile. Il disposera alors d’un espace dédié, au sein duquel il pourra modifier ses informations personnelles, ajouter des annonces dans ses favoris.

Il pourra aussi faire des propositions d’achat, visualiser l’état de ses proposition et accéder à un simulateur de proposition.
Un vendeur a des possibilités d’inscription similaire et peut en supplément, visualiser le nombre de fois que son annonce a été visité, combien de fois elle a été ajoutée en favori ainsi les propositions d’achats faites pour ses biens. Un vendeur est représenté par un agent immobilier de l’agence dans lequel il met en vente son bien. C’est l’agent immobilier qui est charge de la création de l’annonce sur le site.
Sur le site, on considère que les acheteurs, comme les vendeurs, sont des membres. Ainsi, un membre peut être un acheteur ou un vendeur, ou les deux.

Concernant la fonctionnalité de propositions d’achats et de négociation, seules les 5 premières propositions d’achats sont retenues (par ordre chronologique). À chaque nouvelle proposition, le vendeur et son agent immobilier sont notifiés par mail.
Le vendeur peut faire une contre-proposition sur l’offre de son choix. À ce moment-là, les autres propositions d’achats sont bloquées jusqu’à ce que la contre-proposition soit refusée ou acceptée par l’acheteur.
Si la contre-proposition est acceptée, ou qu’une vente est réalisée, tous les clients ayant fait une proposition sur le bien vendu sont notifiés, ainsi que ceux qui avaient l’annonce dans leurs favoris.
Le fonctionnement du simulateur du processus de proposition et contre-proposition est le suivant : un acheteur peut faire une proposition d’achat pour un bien au simulateur. Le simulateur propose alors à l’acheteur des statistiques indiquant les chances qu’a la proposition d’être acceptée, refusée, ou soumise à contre-proposition.
