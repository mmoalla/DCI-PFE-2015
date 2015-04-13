<?php $this->layout = false; ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myLargeModalLabel"><i class="fa fa-user"></i>&nbsp;<?php echo $detpt['Patient']['prenom'] . ' ' . $detpt['Patient']['nom']; ?></h4>
</div>
<div class="modal-body" style="font-size: 20px;text-align: justify;">
    <?php
    echo $this->Form->create('Patient', array(
        'inputDefaults' => array('div' => false, 'label' => false), 'class' => 'form-horizontal',
        'type'=>'file'
            // 'url' => array('controller' => 'patients', 'action' => 'edit', $detpt['Patient']['_id']),
    ));
    echo $this->Form->input('Patient._id');
    ?>
    <div class="col-lg-6" style="padding-left: 25px;padding-right: 25px;">
        <div class="form-group">
            <label for="nom" class="control-label">Nom du patient&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.nom', array('class' => 'form-control', 'id' => 'nom', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="prenom" class="control-label">Prénom du patient&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.prenom', array('class' => 'form-control', 'id' => 'prenom', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="birthdate" class="control-label">Date de naissance&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.birthdate', array('class' => 'form-control', 'type' => 'text', 'id' => 'birthdate', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="sexe" class="control-label">Sexe&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.sexe', array('class' => 'form-control', 'id' => 'sexe', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="nationalite" class="control-label">Nationalité&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.nationalite', array('class' => 'form-control', 'id' => 'nationalite', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="job" class="control-label">Profession &nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.job', array('class' => 'form-control', 'id' => 'job', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="adresse" class="control-label">Adresse&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.adresse', array('class' => 'form-control', 'id' => 'adresse', 'required' => true)); ?>
        </div>        
        <div class="form-group">
            <label for="ville" class="control-label">Ville&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.ville', array('class' => 'form-control', 'id' => 'ville', 'required' => true)); ?>
        </div>        
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="tel" class="control-label">Téléphone&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.tel', array('class' => 'form-control', 'id' => 'tel', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">email&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.email', array('class' => 'form-control', 'id' => 'email', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="age" class="control-label">Age&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.age', array('class' => 'form-control', 'id' => 'age', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="taille" class="control-label">Taille&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.taille', array('class' => 'form-control', 'id' => 'taille', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="poids" class="control-label">Poids&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.poids', array('class' => 'form-control', 'id' => 'poids', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="blood" class="control-label">Groupe sanguin&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.blood', array('class' => 'form-control', 'id' => 'blood', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="numss" class="control-label">N° sécurité sociale&nbsp;&ast;</label>
            <?php echo $this->Form->input('Patient.numss', array('class' => 'form-control', 'id' => 'numss', 'required' => true)); ?>
        </div>
        <div class="form-group">
            <label for="avatar" class="control-label">Avatar&nbsp;&ast;</label>     
            <?php echo $this->Form->input('Patient.avatar', array('class' => 'form-control', 'id' => 'avatar', 'type' => 'file', 'required' => true)); ?>
        </div>
    </div>
    <?php
    echo $this->Form->submit(__('Enregistrer'), array(
        'class' => 'btn btn btn-success',
        'style' => 'width:100%;',
        'div' => false,
        'id' => 'submit'
    ));
    ?>
</div>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
jQuery().ready(function (){
    $("#view_avatar").click(function (e){
        e.preventDefault();
        $("#logo").toggle();
    });
});
<?php echo $this->Html->scriptEnd(); ?>