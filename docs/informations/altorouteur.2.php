<?php
//  ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
//  ? ---------------------------------------------------------- ALTOROUTER ---------------------------------------------------------- ?
//  ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
//  ?                                                                                                                                  ?
//  ?   Le composer 'Altorouter' va nous permettre de gérer et dispatcher les routes URL de notre site                                 ?
//  ?                                                                                                                                  ?
//  ?   Ce composer dispose des méthodes suivantes :                                                                                   ?
//  ?                                                                                                                                  ?
//  ?   getRoutes()                                                                                                                    ?
//  ?   addRoutes($routes)                                                                                                             ?
//  ?   setBasePath($basePath)                                                                                                         ?
//  ?   addMatchTypes(array $matchTypes)                                                                                               ?
//  ?   map($method, $route, $target, $name = null)                                                                                    ?
//  ?   generate($routeName, array $params = [])                                                                                       ?
//  ?   match($requestUrl = null, $requestMethod = null)                                                                               ?
//  ?   compileRoute($route)                                                                                                           ?
//  ?                                                                                                                                  ?
//  ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
//! ETAPE 1 : On inclus, au tout début du point d'entrée du site notre 'autoload' qui permettra de récupérer les 'composer' installés
require_once __DIR__ . "/../vendor/autoload.php";
//! ETAPE 2 : On instancie 'AltoRouter'
$router = new AltoRouter();
//! ETAPE 3 : On précise précise à 'Altorouter' dans quel sous dossier on se trouve sans quoi il essaiera de faire correspondre les URL des routes à partir de localhost par exemple
$router->setBasePath($_SERVER['BASE_URI']);
// '$_SERVER['BASE_URI']' => chemin jusqu'à la racine du projet
//! ETAPE 4 : On map nos routes
// En gros, on dit a AltoRouter de mettre les routes suivantes dans un tableau (interne à la classe)
//? ____________________________________________________________________________________________________________________________________
//? |                                                  DETAIL DE LA METHODE 'map()'                                                    |
//? |----------------------------------------------------------------------------------------------------------------------------------|
//? |                                                                                                                                  |
//? |    PREMIER ARGUMENT                                                                                                              |
//? |      'GET' ou 'POST' par exemple                                                                                                 |
//? |                                                                                                                                  |
//? |    SECOND ARGUMENT                                                                                                               |
//? |      L'URL (ou le modèle d'URL) qui va correspondre a cette route                                                                |
//? |                                                                                                                                  |
//? |    TROSIEME ARGUMENT                                                                                                             |
//? |      Qu'est-ce qu'on fait si on demande cette route ?                                                                            |
//? |      On fait une chaine de caractère qui contient les mêmes infos (nom du controller et de la méthode)                           |
//? |      que l'ont sépare par un caractère spécial au choix (ici @)                                                                  |
//? |                                                                                                                                  |
//? |    QUATRIEME ARGUMENT                                                                                                            |
//? |      Nom de la route a titre indicatif. Par convention, on l'appelle avec le nom du controller . le nom de la méthode appellée   |
//? |                                                                                                                                  |
//? |__________________________________________________________________________________________________________________________________|
// ROUTES VERS LE MAINCONTROLLER
$router->map( "GET", "/",                   "MainController@home",      "main.home"     );
$router->map( "GET", "/lespages",           "MainController@pages",     "main.pages"    );
// ROUTES VERS LE PAGESCONTROLLER
$router->map( "GET", "/lespages/[i:id]",    "PagesController@pages",    "pages.pages"   );
//! ETAPE 5 : ON MATCH NOS ROUTES
//? !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//? !!                                                                                                                                 !!
//? !!  Ici, on demande a AltoRouter de récupérer les infos de la route qui 'match' (correspond) à l'URL actuellement demandée.        !!
//? !!  'match()' ne fait QUE retourner les infos de la route qui correspond                                                           !!
//? !!  C'est a nous d'executer la bonne action (ici instancier le controller et call la méthode)                                      !!
//? !!                                                                                                                                 !!
//? !!  $router->match() renvoi ces infos sous forme d'un tableau associatif à 3 entrées :                                             !!
//? !!                                                                                                                                 !!
//? !!  [                                                                                                                              !!
//? !!    "target" => Qui va contenir "l'action" a faire (le 3e parametre de ->map() ),                                                !!
//? !!    "params" => Qui va contenir les variables de l'URL (un tableau vide s'il n'y en a pas),                                      !!
//? !!    "name"   => Le nom de la route qui match                                                                                     !!
//? !!  ]                                                                                                                              !!
//? !!                                                                                                                                 !!
//? !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$routeInfo = $router->match();
//  TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO 
//  TODO                                                                                                                              TODO 
//  TODO ------------------------------------------------------- BON A SAVOIR ------------------------------------------------------- TODO  
//  TODO                                                                                                                              TODO 
//  TODO     Si $router->match() ne trouve aucune route qui correspond, $routeInfo vaudra false (et ne sera donc pas un tableau)      TODO  
//  TODO     Par conséquent, il est désormais aisé de générer une page "404" dans le cas où la route demandée n'existe pas            TODO 
//  TODO     On peut donc soit le gérer dans l'index, soit en faire une méthode ou un controller de type ErrorController              TODO 
//  TODO                                                                                                                              TODO 
//  TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO 
if( $routeInfo === false ) {
    http_response_code(404);
    echo 'Page non trouvée (404 Not Found)';
    exit();
};
//! ETAPE 6 : MISE EN PLACE DU DISPATCHEUR
// C'est celui qui va instancier le bon controlleur puis qui va appeller et éxecuter la bonne méthode
// A ce stade, l'information qu'on cherche se trouve dans '$routeInfo['target']'.
// Il nous suffit de séparer le resultat à partir du '@'.
// Pour cela, nous utiliserons 'explode()'.
$routeInfoArray = explode( "@", $routeInfo['target'] );