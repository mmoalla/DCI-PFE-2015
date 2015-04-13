<?php echo $this->Html->css($this->Html->url('/js/select2/select2.css', true), array('inline' => false)); ?>
<?php echo $this->Html->css($this->Html->url('/js/select2/select2-bootstrap.css', true), array('inline' => false)); ?>
<?php echo $this->Html->css($this->Html->url('/js/select2/select2-metronic.css', true), array('inline' => false)); ?>
<div class="row">
    <div class="container">
        <h1>Modification de l'employé</h1>
        <?php
        echo $this->Form->create('User', array('inputDefaults' =>
            array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'users', 'action' => 'admin_edit')));
        echo $this->Form->input('User._id');
        ?>
        <div class="col-lg-6" style="padding-left: 25px;padding-right: 25px;">
            <div class="form-group">
                <label for="username" class="control-label">Nom d'utilisateur</label>
                <?php echo $this->Form->input('User.username', array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'ex: d01med', 'title' => 'Ce champs est obligatoire. Il doit contenir suite de lettre et de chiffre')); ?>
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Mot de passe</label>
                <?php echo $this->Form->input('User.password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'ex: sa01al', 'title' => 'Ce champs est obligatoire. Il doit contenir suite de lettre et de chiffre')); ?>
            </div>
            <div class="form-group">
                <label for="role" class="control-label">Role</label>
                <?php echo $this->Form->input('User.group_id', array('class' => 'form-control', 'empty' => '(choisissez le role)')) ?>
            </div>
            <div class="form-group">
                <label for="nom" class="control-label">Nom</label>
                <?php echo $this->Form->input('User.nom', array('class' => 'form-control', 'id' => 'nom')); ?>
            </div>
            <div class="form-group">
                <label for="prenom" class="control-label">Prénom</label>
                <?php echo $this->Form->input('User.prenom', array('class' => 'form-control', 'id' => 'prenom', 'type' => 'text')); ?>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">Téléphone</label>
                <?php echo $this->Form->input('User.phone', array('class' => 'form-control', 'id' => 'phone')); ?>
            </div>
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <?php echo $this->Form->input('User.email', array('class' => 'form-control', 'id' => 'email')); ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="adresse" class="control-label">Adresse</label>
                <?php echo $this->Form->input('User.adresse', array('class' => 'form-control', 'id' => 'adresse')); ?>
            </div>
            <div class="form-group">
                <label for="sexe" class="control-label">Sexe</label>
                <?php echo $this->Form->input('User.sexe', array('class' => 'form-control', 'id' => 'sexe', 'options' => array('Homme' => 'Homme', 'Femme' => 'Femme'), 'empty' => '(choisissez le sexe)')); ?>
            </div>
            <div class="form-group">
                <label for="service_id" class="control-label">Service</label>
                <?php echo $this->Form->input('User.service_id', array('class' => 'form-control', 'id' => 'service_id', 'empty' => '(choisissez le service)')); ?>
            </div>
            <div class="form-group">
                <label for="poste_id" class="control-label">Poste</label>
                <?php echo $this->Form->input('User.poste_id', array('class' => 'form-control', 'id' => 'poste_id', 'empty' => '(choisissez le service)')); ?>
            </div>
            <div class="form-group">
                <label for="formation" class="control-label">Formation</label>
                <?php echo $this->Form->input('User.formation', array('class' => 'form-control', 'id' => 'formation', 'cols' => 3, 'rows' => 6)); ?>
            </div>
            <div id="choiceTit" class="form-group">
                <label for="titulaire" class="control-label">Titulaire ?</label>
                <?php echo $this->Form->input('User.titulaire', array('id' => 'titulaire')); ?>
            </div>
            <div class="form-group">
                <label for="status" class="control-label">Disponible ?</label>
                <?php echo $this->Form->input('User.status', array('id' => 'status')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->submit(__('Enregistrer'), array(
                'class' => 'btn btn btn-success',
                'style' => 'width:100%;',
                'div' => false
            ));
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<?php echo $this->Html->script('select2/select2.min', array('inline' => false)); ?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
$("#service_id").select2();
$("#UserGroupId").select2();
<?php $this->Html->scriptEnd(); ?>