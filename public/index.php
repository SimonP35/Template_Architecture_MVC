<?php 

//! FRONT CONTROLLER : POINT D'ENTRÉE DE NOTRE SITE POUR LES UTILISATEURS : index.php

// Require du fichier autoload.php pour l'utilisations de nos composants et le chargement automatique de nos classes contenues dans nos namespaces (voir composer.json)
//! Ne pas oublier de faire ces namespaces au préalable, de modifier le composer.json pour le chargement de nos classes et de reboot l'autoload après
require_once __DIR__ . "/../vendor/autoload.php";

//! MISE EN PLACE D'ALTOROUTEUR

// Etape 1 : On instancie un objet AltoRouter
$router = new AltoRouter();

// Etape 2 : On précise a AltoRouter notre emplacement (le sous-dossier actuel) afin d'éviter qu'il parte du nom de domaine/de la racine (localhost chez nous)
$router->setBasePath( $_SERVER['BASE_URI'] ); // $_SERVER['BASE_URI'] Donne l'adresse absolue de notre point d'entrée

// Etape 3 : Mise en place/création de nos routes ("mappage" de nos routes)
$router->map( "GET", "URL", "nomDuController@nomDeLaMethode", "nomDuController.nomDeLaMethode" ); // Exemple de Route statique (Exemple : Route d'accueil)
$router->map( "GET", "URL/[i:id]", "ExampleController@example", "example.example" ); // Exemple de Route dynamique (Exemple : Route de catalogue)

// Etape 4 : On match nos routes pour récupérer les infos de la route (on vérifie avec dump($match) qu'une route a bien été detectée par Altorouter)
//! Si la route n'existe pas $match vaudra "false" 
$match = $router->match();

// Etape 5 : Mise en place du DISPATCHER (Celui qui instancie le bon controlleur et exécute la bonne méthode )

//! DEBUT UTILISATION ALTO DISPATCHER

$dispatcher = new Dispatcher($match, 'ErrorController@err404');
$dispatcher->setControllersNamespace('Example\Controllers');
$dispatcher->dispatch();

//!========================================================
//!                     RÉSUMÉ 
//!========================================================

$router = new AltoRouter(); // Etape 1 : On instancie un objet AltoRouter
$router->setBasePath( $_SERVER['BASE_URI'] ); // Etape 2 : On précise a AltoRouter notre emplacement (le sous-dossier actuel) afin d'éviter qu'il parte du nom de domaine (localhost chez nous)
$router->map( "GET", "URL", "NomDuController@nomDeLaMethode", "NomDuController-nomDeLaMethode" ); // Etape 3 : Mise en place/création de nos routes ("mappage" de nos routes)
$match = $router->match(); // Etape 4 : On match nos routes pour récupérer les infos de la route (on vérifie avec dump($match) (qu'une route a bien été detectée par Altorouter)
// Etape 5 : Mise en place du Dispatcher "Home Made" (Celui qui instancie le bon Controller et exécute la bonne méthode )
$matchArray = explode( "@ ou -", $match['target'] ); // Découpage des informations contenues dans $match['target']
$controllerName = $matchArray[0]; // Récupération du nom du Controller
$methodName = $matchArray[1]; // Récupération du nom de la méthode
$controller = new $controllerName(); // Instanciation dynamique du Controller
$controller->$methodName( $match['params'] ); // Instanciation dynamique de la méthode du Controller appelé avec les parties variables éventuelles de l'URL
// Etape 5 : Mise en place d'AltoDispatcher
$dispatcher = new Dispatcher($match, 'ErrorController@err404');
$dispatcher->setControllersNamespace('Example\Controllers');
$dispatcher->dispatch();
