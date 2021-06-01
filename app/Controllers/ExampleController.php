<?php 

//! ExampleController (Gestion de l'affichage de la page example)

// Gère l’aspect dynamique de l’application :
// A partir de l’action demandée (requête utilisateur), il récupère les données (avec le Model) les injecte dans la vue adéquate, et envoie la réponse produite.

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace Example\Controllers;

//! use

// Modèles utilisés
use \Example\Models\Example;

class ExampleController extends CoreController
{
    //!===========================================
    //!               Méthodes
    //!===========================================

    public function example($routeVarInfos)
    {
        //Création des Models ici

        $exampleModel = new Example();
        $example = $exampleModel->find($routeVarInfos['id'], 'example', 'Example');

        // Tableau des données à transmettre

        $viewVars = [
            'exampleModel'=>$exampleModel
        ];

        $this->show("example", $viewVars);
    }

}