<?php
require_once 'Controleur/ControleurSecurise.php';
require_once 'Framework/Controleur.php';
require_once 'Modele/Comptesrendus.php';
require_once 'Modele/Praticien.php';
require_once 'Modele/Visiteur.php';

// Contrôleur des actions liées aux praticiens
class ControleurComptesrendus extends ControleurSecurise {

    // Objet modèle Praticien
    private $praticiens;
    private $compterendu;

    public function __construct() {
        $this->praticiens = new Praticien();
        $this->compterendu = new ComptesRendus();
    }

    // Affiche la liste des praticiens
    public function index() {
        $praticiens = $this->praticiens->getPraticiens();
        $this->genererVue(array('praticiens' => $praticiens));
    }
    
        // Ajoute un compte rendu
    public function ajouter() {
        $idPraticien = $this->requete->getParametre("id");
        $idVisiteur = $this->requete->getSession()->getAttribut("idVisiteur");
        $dateRapport = $this->requete->getParametre("date");
        $motif = $this->requete->getParametre("motif");
        $bilan = $this->requete->getParametre("bilan");
        $this->compterendu->ajouterCompteRendu($idPraticien, $idVisiteur, $dateRapport, $motif, $bilan);
        
        // Exécution de l'action par défaut pour réafficher la liste des billets
        $this->genererVue();
        
    }
}
