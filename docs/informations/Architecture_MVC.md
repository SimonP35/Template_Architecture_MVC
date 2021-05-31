# Fiche Kourou

https://kourou.oclock.io/ressources/fiche-recap/architecture-mvc-model-view-controller/

__Schéma Récap'__ :

https://kourou.oclock.io/mvc/

## Models

Gère l’accès aux entités manipulées par l’application:

protège l’intégrité des données en implémentant la logique métier
s’occupe du stockage
La définition des entités elles-mêmes (produit, utilisateur, employé) peut être séparée de l’accès aux données.

La couche Model est l’ensemble des classes qui définissent les objets manipulés par l’application, qui contiennent les données et réalisent les opérations de stockage.

Plusieurs stratégies existent pour implémenter cette couche de l’application.

### Controller

Gère l’aspect dynamique de l’application :
A partir de l’action demandée (requête utilisateur), il récupère les données (avec le Model) les injecte dans la vue adéquate, et envoie la réponse produite.
(selon l’implémentation, parfois c’est la vue qui renvoie elle-même la réponse)

#### Le Front Controller

Objectif: centraliser les requêtes à l’application en un « Single Point of Entry », qui va analyser la requête et appeler l’action correspondante, du Controller correspondant.

Le FrontController implémente 2 étapes de traitement:

le routage de la requête (recevoir la requête, identifier l’action à éxécuter et les paramètres)
le dispatch (instancier le Controller et éxécuter l’action)
