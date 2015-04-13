<?php $this->layout = 'default_admin'; ?>
<div class="row" style="margin-top: 30px;">
    <?php
    echo $this->Form->create('User', array('inputDefaults' =>
        array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'groups', 'action' => 'admin_add')));
    ?>
    <div class="form-group">
        <label for="name" class="control-label">group name</label>
        <?php echo $this->Form->input('name', array('class' => 'form-control', 'id' => 'username')); ?>
    </div>

    <?php
    echo $this->Form->submit(__('Enregistrer'), array('class' => 'btn btn btn-success', 'div' => false));
    echo $this->Form->end();
    ?>
</div>