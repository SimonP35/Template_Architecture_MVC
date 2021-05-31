Model & Active Record
:newspaper:  

Un Model est une classe qui représente une entité du MCD.  

Une entité du MCD a été transformé en table dans la BDD.  

On a donc un model par table de la BDD.
Les propriétés de cette classe vont correspondre à chaque colonne de la table de la BDD.  

A tel point que les propriétés et les colonnes de la table sont nommées à l'identique.  

!On crée nos requêtes sql et on récupère son contenu avec ->query dans une variable $statement ou $pdoStatement :

```php
$pdo = Database::getPDO();            
$sql = "SELECT * FROM `product`";
$statement = $pdo->query( $sql );            
```
:rolled_up_newspaper:
PDO nous facilite énormément la tâche grâce au paramètre `PDO::FETCH_CLASS` ou `->fetchObject()`
```php
$instancesModel = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'nomClasseModel');
$instancesModel = $pdoStatement->fetchObject( 'nomClasseModel' );
```
Ici PDO nous créer une instance de la Classe `nomClasseModel` pour chaque résultat, il y remplit toutes les propriétés avec les valeurs de la colonne qui porte le même nom :muscle:

La méthode `$pdoStatement->fetch()` ne puvant plus fonctionner, on va donc utiliser une nouvelle méthode `$pdoStatement->fetchObject()`
```php
$instancesModel = $pdoStatement->fetchObject('nomClasseModel');
```
Trop facile ! Merci PDO :pray:

:warning:  
Un Model ne peut pas avoir de requètes utilisant une autre table, cette requète doit être dans son Model