<?php

//! ErrorController (Gestion de l'affichage de la page de l'erreur 404)

// Gère l’aspect dynamique de l’application :
// A partir de l’action demandée (requête utilisateur), il récupère les données (avec le Model) les injecte dans la vue adéquate, et envoie la réponse produite.

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace Example\Controllers;

class ErrorController extends CoreController
{
    //!===========================================
    //!               Méthodes
    //!===========================================

    public function err404()
    {
        $this->show( "err404" );
    }
}