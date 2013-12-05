<?php $this->titre = "Comptes-Rendus"; ?>

<?php
$menuComptesRendus = true;
require 'Vue/_Commun/navigation.php';

?>

<div class="container">
    <h2 class="text-center">Liste de vos comptes-rendus</h2>
    <?php if (isset($msgErreur)): ?>
        <div class="alert alert-info">
            <?= $msgErreur ?></div>
    <?php else : ?>
    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Praticien</th>
                    <th>Ville</th>
                    <th>Motif</th>
                </tr>
            </thead>
            <?php foreach ($comptesRendus as $compteRendu): ?>
                <tr>
                    <td><?= $this->nettoyer($compteRendu['dateRapport']) ?></a></td>
                    <td><?= $this->nettoyer($compteRendu['nomPraticien']) . " " . $this->nettoyer($compteRendu['prenomPraticien']) ?></td>
                    <td><?= $this->nettoyer($compteRendu['villePraticien']) ?></a></td>
                    <td><?= $this->nettoyer($compteRendu['motif']) ?></a></td>
                    <td>
                            <a href="comptesrendus/modification/<?= $this->nettoyer($compteRendu['idRapport']) ?>" class="btn btn-info" title="Modifier">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <button type="button"class="btn btn-danger" title="Supprimer" data-toggle="modal" data-target="#dlgConfirmation">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                            <!-- Dialogue modal de confirmation de suppression -->
                            <!-- Doit être numéroté pour être associé à chaque CR -->
                            <div class="modal fade" id="dlgConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Demande de confirmation</h4>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer ce compte-rendu ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <a href="comptesrendus/supprimer/<?= $this->nettoyer($compteRendu['idRapport']) ?>" class="btn btn-danger">Supprimer</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>


