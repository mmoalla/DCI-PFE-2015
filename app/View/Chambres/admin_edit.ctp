<div class="row" style="margin-top: 30px;">
    <div class="container">
        <h1>Modification de la chambre </h1>
        <?php
        echo $this->Form->create('Chambre', array('inputDefaults' =>
            array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'chambres', 'action' => 'edit')));
        echo $this->Form->input('_id');
        ?>
        <div class="form-group" style="margin: 0;">
            <label for="numero" class="control-label">N° de chambre&nbsp;&ast;</label>
            <?php echo $this->Form->input('numero', array('class' => 'form-control', 'id' => 'numero')); ?>
        </div>
        <div class="form-group" style="margin: 0 0 10px 0;">
            <label for="nbrlit" class="control-label">Nombre de lit&nbsp;&ast;</label>
            <?php echo $this->Form->input('nbrlit', array('class' => 'form-control', 'id' => 'nbrlit')); ?>
        </div> 
        <?php
        echo $this->Form->submit(__('Enregistrer'), array(
            'class' => 'btn btn btn-success',
            'style' => 'width:100%;',
            'div' => false
        ));
        ?>
    </div>
</div>