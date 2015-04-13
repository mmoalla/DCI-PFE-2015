<div class="row" style="margin-top: 30px;">
    <div class="container">
        <h1><i class="fa fa-bed"></i> Gestion des chambres <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Ajouter</a></h1><hr>
        <table class="table table-striped table-hover table-bordered table-condensed table-responsive">
            <thead>
                <tr>
                    <th>N° chambre</th>
                    <th>Nombre de lits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php if (empty($chambres)): ?>
                <tbody><tr><td colspan="8" style="font-size: 30px;text-align: center;font-weight: bold;">Il n'y a pas de chambre dans cet hôpital</td></tr></tbody>
            <?php else: ?>
                <tbody>
                    <?php foreach ($chambres as $chambre): $chambre = $chambre['Chambre']; ?>
                        <tr>
                            <td><?php echo $chambre['numero']; ?></td>
                            <td><?php echo $chambre['nbrlit']; ?></td>
                            <td style="width: 200px;">
                                <?php echo $this->Html->link("Modifier", array('controller' => 'chambres','action' => 'admin_edit', $chambre['_id']), array('class' => 'btn btn-warning btn-xs')); ?>
                                <?php echo $this->Html->link("Supprimer", array('action' => 'admin_delete', $chambre['_id']), array('class' => 'btn btn-danger btn-xs'), "Êtes vous sur de vouloir supprimer la chambre n° " . $chambre['numero'] . " ?"); ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>
        </table> 

    </div>
</div>

<!--  Modal  -->
<div class="modal fade bs-example-modal-lg in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __("Ajout Chambre "); ?></h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('Chambre', array('inputDefaults' =>
                    array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'chambres', 'action' => 'admin_add')));
                ?>
                <div class="form-group">
                    <label for="numero" class="control-label">N° chambre&nbsp;&ast;</label>
                    <?php echo $this->Form->input('numero', array('class' => 'form-control', 'id' => 'numero','required' => true, 'min' => 1, 'title' => 'Ce champs est obligatoire. Il doit contenir un numéro')); ?>
                </div>
                <div class="form-group">
                    <label for="nbrlit" class="control-label">Nombre de lit&nbsp;&ast;</label>
                    <?php echo $this->Form->input('nbrlit', array('class' => 'form-control', 'id' => 'nbrlit', 'required' => true, 'min' => 1, 'title' => 'Ce champs est obligatoire. Il doit contenir un numéro')); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                echo $this->Form->submit(__('Enregistrer'), array('class' => 'btn btn btn-success', 'div' => false));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>