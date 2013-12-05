<?php

require_once 'Framework/Modele.php';

// Services métier liés aux praticiens 
class ComptesRendus extends Modele {
    
    private $sqlRapport = 'select id_rapport as idRapport, P.id_praticien as idPraticien, id_visiteur as idVisiteur, date_rapport as dateRapport, ville_praticien as villePraticien, motif, bilan, nom_praticien as nomPraticien, prenom_praticien as prenomPraticien from rapport_visite RV join PRATICIEN P on RV.id_praticien=P.id_praticien';

    // Renvoie la liste des comptes rendus
    public function getComptesRendus() {
        $sql = $this->sqlRapport . ' order by nom_praticien';
        $comptesRendus = $this->executerRequete($sql);
        return $comptesRendus;
    }
    
    // Renvoie un médicament à partir de son identifiant
    public function getCompteRendu($idRapport) {
        $sql = $this->sqlRapport . ' where id_rapport = ?';
        $compteRendu = $this->executerRequete($sql, array($idRapport));
        if ($compteRendu->rowCount() == 1)
            return $compteRendu->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun médicament ne correspond à l'identifiant '$idRapport'");
    }
    
    public function ajouterCompteRendu($praticien, $idVisiteur, $dateRapport, $motif, $bilan) {
        $sql = 'insert into RAPPORT_VISITE(id_praticien, id_visiteur, date_rapport, motif, bilan)'
            . ' values(?, ?, ?, ?, ?)';
        $this->executerRequete($sql, array($praticien, $idVisiteur, $dateRapport, $motif, $bilan));
    }
    
    public function modifierCompteRendu($motif, $bilan, $idRapport) {
        $sql = 'update rapport_visite set motif = ?, bilan = ? where id_rapport = ?';
        $this->executerRequete($sql, array($motif, $bilan, $idRapport));
    }
    
    public function supprimerCompteRendu($idRapport) {
        $sql = 'delete from RAPPORT_VISITE where id_rapport = ?';
        $this->executerRequete($sql, array($idRapport));
    }

}