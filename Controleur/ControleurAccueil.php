<?php
require_once 'Controleur/ControleurSecurise.php';
require_once 'Framework/Controleur.php';

// Contrôleur de l'accueil
class ControleurAccueil extends ControleurSecurise {

    // Affiche la page d'accueil
    public function index() {
        $this->genererVue();
    }
    
}