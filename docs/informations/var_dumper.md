# Installation du composant var_dumper

Lien vers le site de packagist : https://packagist.org/packages/symfony/var-dumper

## Commande nécessaire pour l'installation dans le terminal

composer require symfony/var-dumper

### Informations complémentaires

!!! Ne pas oublier de require le fichier autoload.php pour lier nos composants à notre point d'entrée !!!

```php
require_once __DIR__ . "/../vendor/autoload.php";
```

```php
dump($variable); // var_dump amélioré
dd($variable);   // dump & die amélioré
```
