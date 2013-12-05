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
    private $compteRendu;

    public function __construct() {
        $this->praticiens = new Praticien();
        $this->compteRendu = new ComptesRendus();
    }

    // Affiche la liste des comptes rendus
    public function index() {
        $comptesRendus = $this->compteRendu->getComptesRendus();
        $msgErreur = "Vous n'avez saisi aucun compte-rendu de visite.";
        
        if ($comptesRendus->rowCount() < 1)
            $this->genererVue(array('msgErreur' => $msgErreur));
        else
            $this->genererVue(array('comptesRendus' => $comptesRendus));
    }
    
    // Page d'ajout de compte rendu
    public function ajout() {
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
        $this->compteRendu->ajouterCompteRendu($idPraticien, $idVisiteur, $dateRapport, $motif, $bilan);
        
        // Exécution de l'action par défaut 
        $this->genererVue();
        
    }
    
            // Modifie un compte rendu
    public function modifier() {
        $idRapport = $this->requete->getParametre("idCR");
        $motif = $this->requete->getParametre("motif");
        $bilan = $this->requete->getParametre("bilan");
        $this->compteRendu->modifierCompteRendu($motif, $bilan, $idRapport);  

        $this->genererVue();
    }
    
    
        // Page modification d'un compte rendu
    public function modification() {
        
        $idRapport = $this->requete->getParametre("id");
        
        $compteRendu = $this->compteRendu->getCompteRendu("$idRapport");
        $this->genererVue(array('compteRendu' => $compteRendu));

    }
    
        // Supprime un compte rendu
    public function supprimer() {
        $idRapport = $this->requete->getParametre("id");
        
        $this->compteRendu->supprimerCompteRendu($idRapport); 
        $this->rediriger("comptesrendus");
    }
}
