<?php 

//! FRONT CONTROLLER : POINT D'ENTRÉE DE NOTRE SITE POUR LES UTILISATEURS : index.php

// Require du fichier autoload.php pour l'utilisations de nos composants (ex : var_dumper ou AlotoRouteur)
require_once __DIR__ . "/../vendor/autoload.php";

//! Mise en commentaire des require suite à l'utilisation de la PSR-4 + autoload 
//! Ne pas oubliez les requires nécessaires si le fichier autoload ne s'en occupe pas :

// Exemple : 

// On inclus nos utilitaires
// require_once __DIR__ . "/../app/utils/Database.php";

// On pense a inclure le fichier qui contient la classe MainController 
// require_once __DIR__ . "/../app/controllers/CoreController.php"; 
// require_once __DIR__ . "/../app/controllers/MainController.php";

// On inclus nos Models
// require_once __DIR__ . "/../app/models/CoreModel.php";
// require_once __DIR__ . "/../app/models/ExampleModel.php";

//! MISE EN PLACE D'ALTOROUTEUR

// Etape 1 : On instancie un objet AltoRouter
$router = new AltoRouter();

// Etape 2 : On précise a AltoRouter notre emplacement (le sous-dossier actuel) afin d'éviter qu'il parte du nom de domaine/de la racine (localhost chez nous)
$router->setBasePath( $_SERVER['BASE_URI'] ); // $_SERVER['BASE_URI'] Donne l'adresse absolue de notre point d'entrée

// Etape 3 : Mise en place/création de nos routes ("mappage" de nos routes)
$router->map( "GET", "URL", "nomDuController@nomDeLaMethode", "nomDuController.nomDeLaMethode" ); // Exemple de Route statique (Exemple : Route d'accueil)
$router->map( "GET", "URL/[i:id]", "ExampleController@example", "example.example" ); // Exemple de Route dynamique (Exemple : Route de catalogue)

// Détail de la méthode map : 
// 1er argument  : La méthode HTTP (Exemple : "GET")
// 2eme argument : L'URL (ou le modèle d'URL) qui va correspondre/déclencher la route avec une partie variable possible [i:id], [a:action]
// 3eme argument : Action réalisée si l'on demande cette route. 
//                 On fait une chaine de caractère qui contient les infos (Séparées pas caractère spécial au choix, ici @ mais - est également possible) : 
//                         - nom du controller
//                         - nom de la méthode 
// 4eme argument : Nom de la route a titre indicatif.

// On peut également le faire en passant un tableau en 3eme paramètre
// $router->map( "GET", "/", [
//     "controller" => "MainController",
//     "method"     => "home",
// ] , "main.home" ); // Route home

// Etape 4 : On match nos routes pour récupérer les infos de la route (on vérifie avec dump($routeInfos) (qu'une route a bien été detectée par Altorouter)
//! Si la route n'existe pas $routeInfos vaudra "false" 
$routeInfos = $router->match();

// Altorouter récupère les infos de la route qui 'match' à l'URL actuellement demandée
// Il retourne ces informations sous la forme d'un tableau associatif à 3 entrées :
// [
//   "target" => Qui va contenir "l'action" a faire (le 3e parametre de ->map() ),
//   "params" => Qui va contenir les variables de l'URL (un tableau vide si la route est statique et un tableau associatif pour une route dynamique),
//   "name"   => Le nom de la route qui match
// ]

// Etape 5 : Mise en place du DISPATCHER (Celui qui instancie le bon controlleur et exécute la bonne méthode )

//! Mise en commentaire du Dispatcher "Home Made" suite à la mise en place d'Alto Dispatcher

// if ($routeInfo === false) 
// {
//     //! Si $routeInfos vaut "false", et donc que la route n'existe pas (elle ne "match" pas)
//     //! On gère notre erreur 404 ici

//     // On appelle donc une méthode error() de notre MainController ou une méthode error() d'un ErrorController
//     $errorPage = new Example\Controllers\ErrorController;
//     $errorPage->err404();
//     exit(); // On arrêt le script ici afin d'éviter que la suite de notre code s'execute.
// }
  
// //! Si la route existe, $routeInfos "match" et nous renvoie les informations nécessaires pour le dispatcher
// // On utilise la fonction explode de PHP pour "découper" la chaine de caractère contenue dans $routeInfo['target'] et en faire un tableau
// $routeInfoArray = explode( "@", $routeInfo['target'] );

// // On récupère nos 2 noms
// $controllerName = $routeInfoArray[0]; // Nom du contrôleur
// $methodName     = $routeInfoArray[1]; // Nom de la méthode

// // On instancie dynamiquement un controlleur dont le nom est stocké dans la variable $controllerName
// $controller = new $controllerName();

// // Puis on appelle dynamiquement sa méthode dont le nom est stocké dans la variable $methodName
// // On lui donne également toute variable passée dans l'URL se trouvant sous forme de tableau dans $routeInfo['params']
// $controller->$methodName( $routeInfo['params'] );

//! DEBUT UTILISATION ALTO DISPATCHER

$dispatcher = new Dispatcher($match, 'ErrorController@err404');
$dispatcher->setControllersNamespace('Example\Controllers');
$dispatcher->dispatch();

//! FIN UTILISATION ALTO DISPATCHER

//!========================================================
//!                     RÉSUMÉ 
//!========================================================

$router = new AltoRouter(); // Etape 1 : On instancie un objet AltoRouter
$router->setBasePath( $_SERVER['BASE_URI'] ); // Etape 2 : On précise a AltoRouter notre emplacement (le sous-dossier actuel) afin d'éviter qu'il parte du nom de domaine (localhost chez nous)
$router->map( "GET", "URL", "NomDuController@nomDeLaMethode", "NomDuController-nomDeLaMethode" ); // Etape 3 : Mise en place/création de nos routes ("mappage" de nos routes)
$routeInfos = $router->match(); // Etape 4 : On match nos routes pour récupérer les infos de la route (on vérifie avec dump($routeInfos) (qu'une route a bien été detectée par Altorouter)
// Etape 5 : Mise en place du Dispatcher "Home Made" (Celui qui instancie le bon Controller et exécute la bonne méthode )
$routeInfosArray = explode( "@ ou -", $routeInfo['target'] ); // Découpage des informations contenues dans $routeInfo['target']
$controllerName = $routeInfosArray[0]; // Récupération du nom du Controller
$methodName = $routeInfosArray[1]; // Récupération du nom de la méthode
$controller = new $controllerName(); // Instanciation dynamique du Controller
$controller->$methodName( $routeInfo['params'] ); // Instanciation dynamique de la méthode du Controller appelé avec les parties variables éventuelles de l'URL
// Etape 5 : Mise en place d'AltoDispatcher
$dispatcher = new Dispatcher($match, 'ErrorController@err404');
$dispatcher->setControllersNamespace('Example\Controllers');
$dispatcher->dispatch();
