# Installation du composant alotrouteur

Lien vers le site de packagist : https://packagist.org/packages/altorouter/altorouter

## Commande nécessaire pour l'installation dans le terminal

composer require altorouter/altorouter

### Informations complémentaires

!!! Ne pas oublier de require le fichier autoload.php pour lier nos composants à notre point d'entrée !!!

```php
require_once __DIR__ . "/../vendor/autoload.php";
```

### Résumé de la mise en place 

```php
$router = new AltoRouter(); // Etape 1 : On instancie un objet AltoRouter
$router->setBasePath( $_SERVER['BASE_URI'] ); // Etape 2 : On précise a AltoRouter notre emplacement (le sous-dossier actuel) afin d'éviter qu'il parte du nom de domaine (localhost chez nous)
$router->map( "GET", "URL", "nomDuController@nomDeLaMethode", "nomDuController-nomDeLaMethode" ); // Etape 3 : Mise en place/création de nos routes ("mappage" de nos routes)
$routeInfos = $router->match(); // Etape 4 : On match nos routes (on vérifie qu'une route a bien été detectée par Altorouter)
// Etape 5 : Mise en place du DISPATCHER (Celui qui instancie le bon Controller et exécute la bonne méthode )
$routeInfosArray = explode( "@", $routeInfo['target'] ); // Découpage des informations contenues dans $routeInfo['target']
$controllerName = $routeInfosArray[0]; // Récupération du nom du Controller
$methodName = $routeInfosArray[1]; // Récupération du nom de la méthode
$controller = new $controllerName(); // Instanciation dynamique du Controller
$controller->$methodName( $routeInfo['params'] ); // Instanciation dynamique de la méthode du Controller appelé avec les parties variables éventuelles de l'URL
```
