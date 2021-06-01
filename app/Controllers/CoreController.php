<?php 

//! CORE CONTROLLER : Controller parent des autres Controllers (contient les propriétés et les méthodes communes dont héritent ses enfants avec extends)

// Gère l’aspect dynamique de l’application :
// A partir de l’action demandée (requête utilisateur), il récupère les données (avec le Model) les injecte dans la vue adéquate, et envoie la réponse produite.

//! namespace

// Chemin de l'emplacement pour l'autoload
namespace Example\Controllers;

//! use

// Modèles utilisés
// use \Example\Models\Example;
// use \Example\Models\Example;

class CoreController 
{
    //!===========================================
    //! Propriétés communes à tous nos Controllers
    //!===========================================

    // Par exemple, le tableau ci-dessous qui va contenir des données issues de Models pour un affichage sur toutes les pages (exemple : Footer ou header): 
    
    protected $commonViewVars = []; 

    //!===========================================
    //! Méthodes communes à tous nos Controllers
    //!===========================================

    public function __construct()
    {
        //! La méthode __construct() se lance dès l'instanciation d'un objet Controller

        // Elle permet de récupérer les variables communes à toutes mes pages en instanciant éventuellement des Models (objets) 
        // et de lancer des méthodes permettant de récupérer le contenu de variables $sql (et donc des données de la DB)

        // Exemple :
        // $brandModel = new Brand() ou $typeModel = new Type(); Instanciation des Models (objets)
        // $footerBrands = $brandModel->findForFooter() ou $footerTypes = $typeModel->findForFooter(); Appel des méthodes contenant les données de la DB (venant de la requeête $sql)
        
        // Je stocke les données des variables communes à toutes mes pages dans ma propriété (tableau) $commonViewvars = [] en créant les clefs adaptées 

        // Exemple :
        // $this->commonViewVars['footerTypes'] = $footerTypes &/ou $this->commonViewVars['footerBrands'] = $footerBrands;

    }

    protected function show( $viewName, $viewVars = [] ) 
    {
        //! La méthode show() permet l'affichage d'une page, elle est donc commune à plusieurs Controllers

        global $router;

        // Si nous possèdons 2 tableaux à transmettre à notre méthode show() on peut les fusionner ici par exemple $commonViewVars (voir le __contsruct() ci-dessus)
        $viewVars = array_merge( $viewVars, $this->commonViewVars ); // $this->commonViewVars est la propriété crée lors de l'instanciation d'un Controller ()

        // On vérifie systématiquement les données éventuelles disponibles dans chaque view/vue (contenues dans la variable $viewVars) pour être sur de récupérer nos données
        dump($viewVars); 
        // NB : $viewVars est disponible dans chaque fichier de vue

        // On appelle notre fichier "view" de façon dynamique avec la variable $viewName
        require_once __DIR__.'/../views/partials/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/partials/footer.tpl.php';
    }

}