<?php $this->layout = false; ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myLargeModalLabel" style="text-transform: uppercase;"><i class="fa fa-calendar"></i>&nbsp;<?php echo $detconsult['Consultation']['motif']; ?></h4>
</div>
<div class="modal-body" style="font-size: 20px;text-align: justify;">
    <div>
        <span style="display: inline-block;">
            <h5>Patient : </h5>
            <?php echo $patient['Patient']['prenom'] . ' ' . $patient['Patient']['nom']; ?>
        </span>
        <span style="display: inline-block;margin-left: 200px;">
            <h5>Motif de consultation : </h5>
            <?php echo $detconsult['Consultation']['motif']; ?>
        </span>
    </div><br>
    <div>
        <h5>Détail</h5>
        <?php echo $detconsult['Consultation']['detail']; ?>
    </div><br>
    <div>
        <span style="display: inline-block;">
            <h5>Date d'entrée</h5>
            <?php echo $detconsult['Consultation']['datedebut']; ?>
        </span>
        <span style="display: inline-block;margin-left: 200px;">
            <h5>Date de sortie</h5>
            <?php echo $detconsult['Consultation']['datefin']; ?>
        </span>
        <span style="display: inline-block;margin-left: 250px;">
            <h5>Heure de l'opération</h5>
            <?php echo $detconsult['Consultation']['heure']; ?>
        </span>
    </div><br>
    <div>
        <span style="display: inline-block;">
            <h5>Medecin traitant</h5>
            <?php echo 'Dr ' . $detuser['User']['prenom'] . ' ' . $detuser['User']['nom']; ?>
        </span>
        <?php if (!empty($chambre)): ?>
            <span style="display: inline-block;margin-left: 181px;">
                <h5>N° chambre</h5>
                <?php echo $chambre['Chambre']['numero']; ?>
            </span>
        <?php endif; ?>
    </div><br>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
</div>