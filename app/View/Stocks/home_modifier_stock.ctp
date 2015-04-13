<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Form->create('Stock', array(
            'inputDefaults' => array('label' => false, 'div' => false), 'url' => array('controller' => 'stocks', 'action' => 'ajouter_stock')
        ));
        
        ?>
        <div class="form-group">
            <label class="control-label">Médicament</label>
            <?php echo $this->Form->input('_id'); ?>
            <?php echo $this->Form->input('medicament_id', array('class' =>'form-control', 'placeholder' => __("Médicament"))); ?>
        </div>
        <div class="form-group">
            <label class="control-label">Quantité</label>
            <?php echo $this->Form->input('stock', array('type' => 'number', 'class' => 'form-control', 'placeholder' => __("Quantité"))); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->submit(__("Envoyer"), array('class' => 'btn btn-info', 'style' => 'width: 300px;')); ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div> 
</div>