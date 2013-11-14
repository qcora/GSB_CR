<?php
require_once 'Framework/Modele.php';

// Services métier liés aux praticiens 
class TypePraticien extends Modele {

    private $sqlTypePraticien = 'select id_type_praticien as idTypePraticien, lib_type_praticien as libTypePraticien, lieu_type_praticien as lieuTypePraticien from TYPE_PRATICIEN';
    
    // Renvoie la liste des praticiens
    public function getTypePraticiens() {
        $sql = $this->sqlTypePraticien . ' order by lib_type_praticien';
        $typePraticiens = $this->executerRequete($sql);
        return $typePraticiens;
    }
    
     
   
}
