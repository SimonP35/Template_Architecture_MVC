<?php

//! Model Example (contient les données relatives à la table 'example' de notre DB)

// Gère l’accès aux entités manipulées par l’application:

// - protège l’intégrité des données en implémentant la logique métier
// - s’occupe du stockage et donc des requêtes sql

// Dans le cadre de la méthode Active Record :
//  - Une classe = Une entité dans le MCD = Une table en DB
//  - Une propriété de cette classe = un champ de cette table

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace Example\Models;

//! use

class Example extends CoreModel 
// Nom de la classe = Nom de la table (sans les maj) et extends pour qu'il hérite des propriétés et methodes du CoreModel
{
    //!===========================================
    //!                 Propriétés 
    //!===========================================

    //Exemple :

    // private $description;
    // private $picture;
    // private $price;
    // private $rate;
    // private $status;        
    
    // Foreign Keys
    // private $brand_id;
    // private $category_id;
    // private $type_id;

    // Rappel :

    //  private   : moi (la classe) uniquement
    //  protected : moi (la classe), et ma famille (mes classes enfants)
    //  public    : tout le monde

    //!===========================================
    //!                  Méthodes
    //!===========================================

    //! Mise en commentaire, les méthodes sont factorisées dans le CoreModel 

    // public function find( $id ) 
    // {
    //     $pdo = Database::getPDO();
    //     $sql = "SELECT * FROM `exemple` WHERE `id` = $id";
    //     $statement = $pdo->query( $sql );
    //     return $statement->fetchObject( "app\models\Type" );
    // }
    
    // public function findAll() 
    // { 
    //     $pdo = Database::getPDO();            
    //     $sql = "SELECT * FROM `exemple`";
    //     $statement = $pdo->query( $sql );            
    //     return $statement->fetchAll( PDO::FETCH_CLASS, "app\models\Type" );
    // }
    
    // Exemple de méthode plus précise permettant de récupérer les données de la table `exemple` avec des conditions (WHERE & ORDER BY) 
    // public function findForFooter() 
    // {
    //     $pdo = Database::getPDO();            
    //     $sql = "SELECT * FROM `exemple` WHERE `footer_order` > 0 ORDER BY `footer_order` ASC";
    //     $statement = $pdo->query( $sql );            
    //     return $statement->fetchAll( PDO::FETCH_CLASS, "app\models\Type" );
    // }

    //===================================================
    // getters ou setters des propriétés de nos Models
    //===================================================

    // Création des getters/setters en faisant un clic-droit (->Insert PHP Getter &/ou Setter) sur les propriétés du Model
}
