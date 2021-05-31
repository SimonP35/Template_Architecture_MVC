# Autoload avec Composer

Y'en a marre de rajouter des require a tout va !

On a mis en place les namespace en respectant la [PSR-4](https://www.php-fig.org/psr/psr-4/)

Composer nous demande qu'une seule chose : lui dire pour un namespace dans quel dossier physique il doit chercher.

namespace app\controllers;
class CatalogController {...}

On va lui donner l'info dans le fichier composer.json

"autoload": {
        "psr-4" : {
            "app\\" : "app/"
        }
    }

Il faut quand même dire à Composer de prendre en compte la modification du fichier composer.json, dans le terminal :

composer dump-autoload
