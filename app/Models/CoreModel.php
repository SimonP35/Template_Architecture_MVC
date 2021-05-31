<?php

//! CORE MODEL : Model parent des autres Models (contient les propriétés et les méthodes communes dont héritent ses enfants avec extends)

// Gère l’accès aux entités manipulées par l’application:

// - protège l’intégrité des données en implémentant la logique métier
// - s’occupe du stockage et donc des requêtes sql

// Dans le cadre de la méthode Active Record :
//  - Une classe = Une entité dans le MCD = Une table en DB
//  - Une propriété de cette classe = un champ de cette table

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace app\Models;

//! use

// Fichier utilisés dans ce Model
use \app\utils\Database;
use \PDO;

class CoreModel
{
    //!===========================================
    //! Propriétés communes à tous nos Models
    //!===========================================

    // On utilise la visibilité "protected" pour permettre
    // aux classes qui héritent de CoreModel de modifier ces valeurs, par exemple :

    // protected $id;
    // protected $name;
    // protected $created_at;
    // protected $updated_at;

    // Rappel :

    //  private   : moi (la classe) uniquement
    //  protected : moi (la classe), et ma famille (mes classes enfants)
    //  public    : tout le monde

    //!===========================================
    //! Méthodes communes à tous nos Models
    //!===========================================

    // Méthode pour récupérer les données de la colonne d'un table précise
    public function find($id, $table, $Model) 
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `$table` WHERE `id` = $id";
        $statement = $pdo->query( $sql );
        return $statement->fetchObject( "app\Models\{$Model}" );
    }      

    // Méthode pour récupérer toutes les données d'une table
    public function findAll($table, $Model) 
    { 
        $pdo = Database::getPDO();            
        $sql = "SELECT * FROM `$table`";
        $statement = $pdo->query( $sql );            
        return $statement->fetchAll( PDO::FETCH_CLASS, "app\Models\{$Model}" );
    }

    // Méthode pour récupérer toutes les données d'une table dans un ordre ASC
    public function findAllOrderByASC($table, $Model, $order)
    {
        $pdo = Database::getPDO();            
        $sql = "SELECT * FROM `$table` ORDER BY `$order` ASC";
        $statement = $pdo->query( $sql );            
        return $statement->fetchAll( PDO::FETCH_CLASS, "app\Models\{$Model}" );
    }

    // Méthode pour récupérer toutes les données d'une table dans un ordre DESC
    public function findAllOrderByDESC($table, $Model, $order)
    {
        $pdo = Database::getPDO();            
        $sql = "SELECT * FROM `$table` ORDER BY `$order` DESC";
        $statement = $pdo->query( $sql );            
        return $statement->fetchAll( PDO::FETCH_CLASS, "$Model" );
    }


    //==============================================================
    // getters ou setters des propriétés communes à tous nos Models
    //==============================================================

    // Création des getters/setters en faisant un clic-droit (->Insert PHP Getter &/ou Setter) sur les propriétés du Model
}
