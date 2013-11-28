<?php

require_once 'Framework/Modele.php';

// Services métier liés aux praticiens 
class ComptesRendus extends Modele {

    public function ajouterCompteRendu($praticien, $idVisiteur, $dateRapport, $motif, $bilan) {
        $sql = 'insert into RAPPORT_VISITE(id_praticien, id_visiteur, date_rapport, motif, bilan)'
            . ' values(?, ?, ?, ?, ?)';
        $this->executerRequete($sql, array($praticien, $idVisiteur, $dateRapport, $motif, $bilan));
    }
}