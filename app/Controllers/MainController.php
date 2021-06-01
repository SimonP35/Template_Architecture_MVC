<?php 

//! MainController (Gestion de l'affichage des pages simples communes/classiques)

// Gère l’aspect dynamique de l’application :
// A partir de l’action demandée (requête utilisateur), il récupère les données (avec le Model) les injecte dans la vue adéquate, et envoie la réponse produite.

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace Example\Controllers;

//! use

// Modèles utilisés
use \Example\Models\Example;

class MainController extends CoreController
{
    //!===========================================
    //!               Méthodes
    //!===========================================

    public function home()
    // Méthode pour lancer l'execution de la méthode show() qui s'occupe d'afficher la page "Home" dans le CoreController (Controller parent)
    // Cette méthode permet également de récupérer au préalable des données issues de variable en lançant les méthodes nécessaires de ceratins Models
    {
        //Création des Models ici

        $exampleModel = new Example();
        $example = $exampleModel->findAll('character', 'Character');

        // Tableau des données à transmettre

        $viewVars = [
            'example'=>$example
        ];

        $this->show("home", $viewVars);
    }

    public function legal() // Méthode pour lancer l'execution de la méthode qui s'occupe d'afficher la page "Mentions Légales" dans le CoreController (Controller parent)
    {
        $this->show("legal");
    }
}