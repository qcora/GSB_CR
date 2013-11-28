<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Visiteur.php';

/**
 * Contrôleur gérant la connexion au site
 *
 */
class ControleurConnexion extends Controleur
{
    private $visiteur;

    public function __construct()
    {
        $this->visiteur = new Visiteur();
    }

    public function index()
    {
        $this->genererVue();
    }

    public function connecter()
    {
        if ($this->requete->existeParametre("login") && $this->requete->existeParametre("mdp")) {
            $login = $this->requete->getParametre("login");
            $mdp = $this->requete->getParametre("mdp");
            if ($this->visiteur->connecter($login, $mdp)) {
                $visiteur = $this->visiteur->getVisiteur($login, $mdp);
                $this->requete->getSession()->setAttribut("idVisiteur",
                        $visiteur['idVisiteur']);
                $this->requete->getSession()->setAttribut("login",
                        $visiteur['login']);
                $this->rediriger("accueil");
            }
            else
                $this->genererVue(array('msgErreur' => 'Login ou mot de passe incorrects'),
                        "index");
        }
        else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }

    public function deconnecter()
    {
        $this->requete->getSession()->detruire();
        $this->rediriger("Connexion");
    }

}
