<?php $this->Html->css('../js/select2/select2', array('inline' => false)); ?>
<?php $this->Html->css('../js/select2/select2-metronic', array('inline' => false)); ?>
<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Form->create('Stock', array(
            'inputDefaults' => array('label' => false, 'div' => false), 'url' => array('controller' => 'stocks', 'action' => 'ajouter_stock')
        ));
        ?>
        <div ng-controller="MedicamentsController">
            <div class="form-group">
                <label class="control-label">Medicament(code_pct)</label>
                <select select ng-model="code" id="code" class="form-control" required>
                    <option value="">Selectionner un code PCT</option>
                    <option ng-repeat="med in medocs" ng-model="code">{{med.Medicament.code_pct}}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Nom médicament</label>
                <?php //echo $this->Form->input('_id'); ?>
                <select select class="form-control" ng-model="code" name="data[Stock][medicament_id]" required>
                    <option ng-selected="code" ng-repeat="med in medocs| filter: code" value="{{med.Medicament._id}}">{{med.Medicament.nom_commercial}}</option>
                </select>
            </div>
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
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$('#code').select2();
<?php $this->Html->scriptEnd(); ?>