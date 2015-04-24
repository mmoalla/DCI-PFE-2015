<?php echo $this->Html->css($this->Html->url('/js/select2/select2.css', true), array('inline' => false)); ?>
<?php echo $this->Html->css($this->Html->url('/js/select2/select2-metronic.css', true), array('inline' => false)); ?>
<div class="row" style="margin-top: 30px;"  id="listeUser">
    <div class="container" ng-controller="UserController">
        <h1>
            <i class="fa fa-users"></i> Gestion du personnel 
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Ajouter</a>
        </h1><hr>
        <div class="form-group" style="margin-bottom: 20px;">
            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 12px 15px;"><i class="fa fa-filter" style="font-size: 16px;"></i></div>
            <input id="name" type="text" class="form-control" ng-model="name" style="padding-left: 50px;" placeholder="Rechercher les docteurs par leur nom, prénom ou téléphone" autocomplete="off" />
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive" >
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Status</th>
                    <th>Titularisation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="usr in users | filter: name" ng-if="usr.User.prenom !== 'Administrateur'">
                    <td>{{usr.User.username}}</td>
                    <td>{{usr.User.nom}}</td>
                    <td>{{usr.User.prenom}}</td>
                    <td>{{usr.User.phone}}</td>
                    <td style="width: 10%;"><span class="label label-info" ng-if="usr.User.status === '1'">Disponible</span><span class="label label-danger" ng-if="usr.User.status === '0'">Non disponible</span></td>
                    <td style="width: 10%;"><span class="label label-info" ng-if="usr.User.titulaire === '1'">Titulaire</span><span class="label label-danger" ng-if="usr.User.titulaire === '0'">&Agrave; l'essaie</span></td>
                    <td style="width: 12%;">
                        <a href="http://localhost/DCI/admin/users/view/{{usr.User._id}}"><i class="btn btn-default btn-xs fa fa-list-alt" style="font-size: 20px;"></i></a>
                        <a href="http://localhost/DCI/admin/users/edit/{{usr.User._id}}"><i class="btn btn-warning btn-xs fa fa-pencil" style="font-size: 20px;"></i></a>
                        <a href="http://localhost/DCI/admin/users/delete/{{usr.User._id}}"><i class="btn btn-danger btn-xs fa fa-trash-o" style="font-size: 20px;"></i></a>
                    </td>
                </tr>
            </tbody>
        </table> 
    </div>
</div>

<!--------------------------------------  Modal  ----------------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __("Ajout Personnel "); ?></h4>
            </div>
            <div class="modal-body clearfix">
                <?php
                echo $this->Form->create('User', array('inputDefaults' =>
                    array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'users', 'action' => 'admin_add')));
                ?>
                <div class="col-lg-6" style="padding-left: 25px;padding-right: 25px;">
                    <div class="form-group">
                        <label for="username" class="control-label">Nom d'utilisateur&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.username', array('class' => 'form-control', 'id' => 'username', 'style' => 'padding: 0 0 0 10px;', 'required' => true, 'placeholder' => 'ex: d01med', 'title' => 'Ce champs est obligatoire. Il doit contenir suite de lettre et de chiffre')); ?>
                        <?php echo $this->Form->input('User._id', array('id' => 'userId')); ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Mot de passe&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.password', array('class' => 'form-control', 'id' => 'password', 'style' => 'padding: 0 0 0 10px;', 'required' => true, 'placeholder' => 'ex: sa01al', 'title' => 'Ce champs est obligatoire. Il doit contenir suite de lettre et de chiffre')); ?>
                    </div>
                    <div class="form-group">
                        <label for="role" class="control-label">Role&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.group_id', array('class' => 'form-control', 'empty' => '(choisissez le role)')) ?>
                    </div>
                    <div class="form-group">
                        <label for="nom" class="control-label">Nom&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.nom', array('class' => 'form-control', 'id' => 'nom', 'style' => 'padding: 0 0 0 10px;', 'required' => true)); ?>
                    </div>
                    <div class="form-group">
                        <label for="prenom" class="control-label">Prénom&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.prenom', array('class' => 'form-control', 'id' => 'prenom', 'type' => 'text', 'style' => 'padding: 0 0 0 10px;', 'required' => true)); ?>
                    </div>
                    <div class="form-group">
                        <label for="birthdate" class="control-label">Date naissance</label>
                        <?php echo $this->Form->input('User.birthdate', array('class' => 'form-control .dp-birthdate', 'id' => 'birthdate', 'type' => 'text', 'style' => 'padding: 0 0 0 10px;background-color: #fff;cursor: default;')); ?>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Téléphone&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.phone', array('class' => 'form-control', 'id' => 'phone', 'style' => 'padding: 0 0 0 10px;', 'required' => true)); ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.email', array('class' => 'form-control', 'id' => 'email', 'style' => 'padding: 0 0 0 10px;', 'required' => true, 'title' => 'Vous devez saisir un email valide')); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="adresse" class="control-label">Adresse</label>
                        <?php echo $this->Form->input('User.adresse', array('class' => 'form-control', 'id' => 'adresse', 'style' => 'padding: 0 0 0 10px;')); ?>
                    </div>
                    <div class="form-group">
                        <label for="sexe" class="control-label">Sexe&nbsp;&ast;</label>
                        <?php echo $this->Form->input('User.sexe', array('class' => 'form-control', 'id' => 'sexe', 'style' => 'padding: 0 0 0 10px;', 'options' => array('Homme' => 'Homme', 'Femme' => 'Femme'), 'empty' => '(choisissez le sexe)', 'required' => true)); ?>
                    </div>
                    <div class="form-group">
                        <label for="formation" class="control-label">Formation</label>
                        <?php echo $this->Form->input('User.formation', array('class' => 'form-control', 'id' => 'formation', 'cols' => 3, 'rows' => 5, 'style' => 'padding: 0 0 0 10px;')); ?>
                    </div>
                    <div class="form-group">
                        <label for="service_id" class="control-label">Service</label>
                        <?php echo $this->Form->input('User.service_id', array('class' => 'form-control', 'id' => 'service_id', 'empty' => '(choisissez le service)')); ?>
                    </div>
                    <div class="form-group">
                        <label for="poste_id" class="control-label">Poste</label>
                        <?php echo $this->Form->input('User.poste_id', array('class' => 'form-control', 'id' => 'poste_id', 'empty' => '(choisissez le poste)')); ?>
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
                <?php
                echo $this->Form->submit(__('Enregistrer'), array(
                    'class' => 'btn btn btn-success',
                    'style' => 'width:100%;',
                    'div' => false,
                    'id' => 'submit'
                ));
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
<?php echo $this->Html->script('select2/select2.min', array('inline' => false)); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
    $("#service_id").select2();
    $('#birthdate').pickadate({
        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
        clear: false,
        close: false,
        today: false,
        labelMonthNext: 'Mois suivant',
        labelMonthPrev: 'Mois précédent',
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        selectYears: true,
        selectMonths: true,
        min: [1970, 01, 01],
        max: [1989, 12, 31]
    });
<?php echo $this->Html->scriptEnd(); ?>