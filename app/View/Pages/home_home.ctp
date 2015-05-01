<?php echo $this->Html->script('http://documentcloud.github.io/underscore/underscore.js', array('inline' => false)); ?>
<?php if ($this->Session->read('group.Group.name') === "docteur"): ?>
    <div class="row">
        <div class="container-fluid">
            <div class="page-header" style="margin: 0;margin-bottom: -30px;">
                <h1>Planning Journalier</h1>
                <!--                <a href="#" class="btn btn-primary btn-sm" style="position: absolute; right: 15px;top: 95px;" id="detailconsult">Plus de détail</a>-->
            </div><hr class="dci-hr">
            <div style="margin-top: 60px;">
                <?php if (!empty($rdvs)): ?>
                    <ul class="dci-timeline">
                        <?php foreach ($rdvs as $rdv): $rdv = $rdv['Consultation']; ?>
                                <li>
                                    <div class="dci-timeline-time">
                                        <span class="dci-date"><?php echo $rdv['datedebut']; ?></span>
                                        <span class="dci-time"><?php echo $rdv['heure']; ?></span>
                                    </div>
                                    <div class="dci-timeline-icon">
                                        <i class="fa fa-calendar" style="top: 3px;left: 1px;"></i>
                                    </div>
                                    <div class="dci-timeline-body">
                                        <h2 style="border: 0;"><?php echo $rdv['motif'] ?></h2>
                                        <div class="dci-timeline-content" style="display: block;border-top: 1px solid rgba(255,255,255,0.3);padding-top: 5px;">
                                            <p>
                                                <span style="font-size: 20px;font-weight: bold;">Détail :</span><br>
                                                <?php if (!empty($rdv['detail'])): ?>
                                                    <?php echo $rdv['detail']; ?>
                                                <?php else : ?>
                                                    <span>Pas de détail</span>
                                                <?php endif; ?>
                                            </p>
                                            <?php foreach ($pts as $pt): ?>
                                                <p style="display: inline-block;width: 25%;"><span style="font-size: 20px;font-weight: bold;">Patient : </span> <?php echo $pt['prenom'] . ' ' . $pt['nom']; ?></p>
                                            <?php endforeach; ?>
                                            <?php foreach ($chbs as $chb): ?>
                                                <p style="display: inline-block;width: 25%;"><span style="font-size: 20px;font-weight: bold;">N° Chambre : </span> <?php echo $chb['numero']; ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-info" style="text-align: center;font-size: 20px;font-weight: bold;">Vous avez de la veine !! Vous n'avez pas de consultation pour ajourd'hui <?php echo $this->Html->image('smile.png'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php elseif ($this->Session->read('group.Group.name') === "bureau admission"): ?>
    <!----------------------------------------------------- FORM WIZARD ------------------------------------------------->
    <?php
    echo $this->Form->create('Facture', array('inputDefaults' =>
        array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'type' => 'file', 'id' => 'addmissionForm',
        'url' => array('controller' => 'consultations', 'action' => 'addAdmission')));
    ?>
    <div id="rootwizard" class="rootwizard portlet box blue">
        <div class="page-header" style="margin: 0;border-bottom: none;">
            <h1>Bureau d'admission&nbsp;
                <input class="form-control" type="text" autocomplete="off" list="searchcomplete" id="search" type="search" placeholder="Recherche patient...." style="width: 300px;display: inline-block;position: absolute;top: 70px;"/>
            </h1>
            <div id="ressearch" style="display: none;"></div>
        </div><div class="dci-hr"></div>
        <div class="portlet-body form">
            <!------------------------------------ TABS NAVIGATION ------------------------------------->
            <ul class="nav nav-pills nav-justified steps" >
                <li class="active" style="cursor: pointer;">
                    <a href="#tab1" role="tab" data-toggle="tab" class="step">
                        <span class="number">1</span>
                        <span class="desc"><i class="fa fa-folder"></i> Dossier Patient</span>
                    </a>
                </li>
                <li style="cursor: pointer;">
                    <a href="#tab2" role="tab" data-toggle="tab" class="step">
                        <span class="number">2</span>
                        <span class="desc"><i class="fa fa-calendar"></i> Palnning</span>
                    </a>
                </li>
                <li style="cursor: pointer;">
                    <a href="#tab3" role="tab" data-toggle="tab" class="step">
                        <span class="number">3</span>
                        <span class="desc"><i class="fa fa-credit-card"></i> Facturation</span>
                    </a>
                </li>
                <li style="cursor: pointer;">
                    <a href="#tab4" role="tab" data-toggle="tab" class="step">
                        <span class="number">4</span>
                        <span class="desc"><i class="fa fa-check"></i> Confimation</span>
                    </a>
                </li>
            </ul>
            <!------------------------------------ PROGRESS BAR ------------------------------------->
            <div class="progress">
                <div id="progressBar" class="progress-bar progress-bar-success progress-bar-striped active">
                    <div class="bar">
                        <span></span>
                    </div>
                </div>
            </div>
            <!------------------------------------ FORM 1 : DOSSIER PATIENT ------------------------------------->
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div style="display: none;" id="alert" class="alert alert-danger"></div>
                    <h3 class="block" style="border-bottom: 1px solid #e7e7e7;padding-bottom: 20px;">Fournir les détails du dossier patient</h3>
                    <div class="dci-form-column">
                        <div class="form-group">
                            <label for="nom" class="control-label">Nom</label>
                            <?php
                            echo $this->Form->input('Patient.nom', array('class' => 'form-control', 'id' => 'nom', 'ng-model' => 'nom', 'autocomplete' => "off"));
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="control-label">Prénom</label>
                            <?php
                            echo $this->Form->input('Patient.prenom', array('class' => 'form-control', 'id' => 'prenom', 'ng-model' => 'prenom', 'autocomplete' => "off"))
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="birthdate" class="control-label">Date naissance</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-birthday-cake"></i></div>
                            <?php echo $this->Form->input('Patient.birthdate', array('class' => 'form-control dp-birthdate', 'style' => 'cursor:text;background: #fff;padding-left: 50px;', 'id' => 'birthdate', 'type' => 'text', 'ng-model' => 'birthdate')); ?>
                        </div>
                        <div class="form-group">
                            <label for="sexe" class="control-label">Sexe</label>
                            <?php echo $this->Form->input('Patient.sexe', array('class' => 'form-control', 'id' => 'sexe', 'style' => 'padding: 0 0 0 10px;', 'options' => array('Homme' => 'Homme', 'Femme' => 'Femme'), 'empty' => 'Choisissez le sexe', 'ng-model' => 'sexe')); ?>
                        </div>
                        <div class="form-group">
                            <label for="nationalite" class="control-label">Nationalité</label>
                            <div ng-controller="NationaliteController">
                                <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-globe"></i></div>
                                <select name="data[Patient][nationalite]" id="nationalite" class="form-control" ng-model="nationalite" style="padding-left: 50px;">
                                    <option value="">Choisissez la nationnalité</option>
                                    <option value="{{n.name}}" ng-repeat="n in nt">{{n.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job" class="control-label">Profession</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-briefcase"></i></div>
                            <?php echo $this->Form->input('Patient.job', array('class' => 'form-control', 'id' => 'job', 'ng-model' => 'job', 'autocomplete' => "off", 'style' => 'padding-left:50px;')); ?>
                        </div>
                    </div>
                    <div class="dci-form-column" style="position: relative;top:0px;">
                        <div class="form-group">
                            <label for="adresse" class="control-label">Adresse</label>
                            <?php echo $this->Form->input('Patient.id', array('type' => 'hidden', 'id' => 'idPatient')); ?>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-map-marker"></i></div>
                            <?php echo $this->Form->input('Patient.adresse', array('class' => 'form-control', 'id' => 'adresse', 'ng-model' => 'adresse', 'autocomplete' => "off", 'style' => 'padding-left:50px;')); ?>
                        </div>
                        <div class="form-group">
                            <label for="ville" class="control-label">Ville</label>
                            <?php echo $this->Form->input('Patient.ville', array('class' => 'form-control', 'id' => 'ville', 'ng-model' => 'ville', 'autocomplete' => "off")) ?>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="control-label">Téléphone</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-phone"></i></div>
                            <?php echo $this->Form->input('Patient.tel', array('class' => 'form-control', 'id' => 'tel', 'type' => 'text', 'placeholder' => 'ex: 71222333', 'ng-model' => 'tel', 'autocomplete' => "off", 'maxlength' => '8', 'style' => 'padding-left:50px;')); ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-envelope"></i></div>
                            <?php echo $this->Form->input('Patient.email', array('class' => 'form-control', 'id' => 'email', 'type' => 'text', 'ng-model' => 'email', 'autocomplete' => "off", 'style' => 'padding-left:50px;')); ?>
                        </div>
                        <div class="form-group">
                            <label for="age" class="control-label">Age</label>
                            <?php echo $this->Form->input('Patient.age', array('class' => 'form-control', 'id' => 'age', 'type' => 'text', 'ng-model' => 'age', 'autocomplete' => "off", 'readonly')); ?>
                        </div>
                        <div class="form-group">
                            <label for="taille" class="control-label">Taille</label>
                            <?php echo $this->Form->input('Patient.taille', array('class' => 'form-control', 'id' => 'taille', 'ng-model' => 'taille', 'type' => 'text', 'autocomplete' => "off", 'placeholder' => 'ex: 1.72')); ?>
                        </div>
                    </div>
                    <div class="dci-form-column" id="dci-form-column" style="position: relative;top: -187px;">
                        <div class="form-group">
                            <label for="poids" class="control-label">Poids</label>
                            <?php echo $this->Form->input('Patient.poids', array('class' => 'form-control', 'id' => 'poids', 'ng-model' => 'poids', 'type' => 'text', 'autocomplete' => "off", 'placeholder' => 'ex: 65.5')) ?>
                        </div>
                        <div class="form-group">
                            <label for="blood" class="control-label">Groupe Sanguin</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-heartbeat"></i></div>
                            <?php echo $this->Form->input('Patient.blood', array('class' => 'form-control', 'id' => 'blood', 'style' => 'padding: 0 0 0 50px;', 'options' => array('A+' => 'A+', 'B+' => 'B+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'), 'empty' => 'Choisissez le groupe sanguin', 'ng-model="blood"')); ?>
                        </div>
                        <div class="form-group">
                            <label for="numss" class="control-label">N° Sécu. Soc.</label>
                            <?php echo $this->Form->input('Patient.numss', array('class' => 'form-control', 'id' => 'numss', 'type' => 'text', 'ng-model' => 'numss', 'maxlength' => '10', 'autocomplete' => "off", 'placeholder' => 'Resigner les 10 chiffres')); ?>
                        </div>
                        <div class="form-group" id="pt-avatar">
                            <label for="avatar" class="control-label" id="lblavatar">Image du patient (jpg/png)</label>
                            <div id="avatar-addon" class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-picture-o"></i></div>
                            <?php echo $this->Form->input('Patient.avatar_file', array('class' => 'form-control', 'id' => 'avatar', 'type' => 'file', 'style' => 'padding-left:50px;')); ?>
                        </div>
                    </div>
                    <!------------------------------------ / END FORM 1 : DOSSIER PATIENT ------------------------------------->
                </div>
                <div class="tab-pane" id="tab2">
                    <h3 class="block" style="border-bottom: 1px solid #e7e7e7;padding-bottom: 20px;">Fournir les détails du planning</h3>
                    <!------------------------------------ FORM 2 : PALNNING -------------------------------------------------->
                    <div class="dci-form-column">
                        <div class="form-group">
                            <label for="reference" class="control-label">Motif de consultation</label>
                            <?php
                            echo $this->Form->input('Consultation.motif', array('class' => 'form-control', 'id' => 'motif', 'ng-model' => 'motif', 'autocomplete' => "off"));
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="control-label">Détail de consultation</label>
                            <?php echo $this->Form->textarea('Consultation.detail', array('class' => 'form-control', 'id' => 'detail', 'ng-model' => 'detail')); ?>
                        </div>
                        <div class="form-group">
                            <label for="datedebut" class="control-label">Date de début</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-calendar"></i></div>
                            <?php echo $this->Form->input('Consultation.datedebut', array('class' => 'form-control datepicker', 'style' => 'cursor:text;background: #fff;padding-left:50px;', 'id' => 'datedebut', 'type' => 'text', 'ng-model' => 'datedebut')) ?>
                        </div>
                        <div class="form-group">
                            <label for="datefin" class="control-label">Date de fin</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-calendar"></i></div>
                            <?php echo $this->Form->input('Consultation.datefin', array('class' => 'form-control datepicker', 'style' => 'cursor:text;background: #fff;padding-left:50px;', 'id' => 'datefin', 'type' => 'text', 'ng-model' => 'datefin')) ?>
                        </div>
                        <div class="form-group">
                            <label for="heure" class="control-label">Heure</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-clock-o"></i></div>
                            <?php echo $this->Form->input('Consultation.heure', array('class' => 'form-control timepicker', 'style' => 'cursor:text;background: #fff;padding-left:50px;', 'id' => 'heure', 'type' => 'text', 'ng-model' => 'heure')); ?>
                        </div>
                    </div>
                    <div class="dci-form-column" style="position: absolute;">
                        <div class="form-group">
                            <label for="user_id" class="control-label">Docteur</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-user-md"></i></div>
                            <?php echo $this->Form->input('Consultation.user_id', array('class' => 'form-control', 'id' => 'user_id', 'empty' => 'Choisissez le docteur', 'ng-model' => 'user_id', 'style' => 'padding-left:50px;')); ?>
                        </div>
                        <div class="form-group">
                            <label for="chambre_id" class="control-label">N° de Chambre</label>
                            <div class="input-group-addon" style="width: auto;position: absolute;border-radius: 3px 0 0 3px;padding: 13px;"><i class="fa fa-bed"></i></div>
                            <?php echo $this->Form->input('Consultation.chambre_id', array('class' => 'form-control', 'id' => 'chambre_id', 'empty' => 'Choisissez le n° de la chambre', 'ng-model' => 'chambre_id', 'style' => 'padding-left:50px;')); ?>
                        </div>
                    </div>
                    <!------------------------------------ /END FORM 2 : PLANNING ------------------------------------->
                </div>
                <div class="tab-pane" id="tab3">
                    <h3 class="block" style="border-bottom: 1px solid #e7e7e7;padding-bottom: 20px;">Fournir les détails de la cate de crédit et du paiement</h3>
                    <!------------------------------------ FORM 3 : FACTURE ------------------------------------------->
                    <div class="dci-form-column">
                        <div class="form-group">
                            <label for="designation" class="control-label">Désignation</label>
                            <?php echo $this->Form->input('Facture.designation', array('class' => 'form-control', 'id' => 'designation', 'ng-model' => 'designation', 'autocomplete' => "off", 'readonly')); ?>
                        </div>
                        <div class="form-group">
                            <label for="montant" class="control-label">Montant</label>
                            <?php echo $this->Form->input('Facture.montant', array('class' => 'form-control', 'id' => 'montant', 'ng-model' => 'montant', 'type' => 'text', 'autocomplete' => "off")); ?>
                        </div>
                        <div class="form-group">
                            <label for="nationalite" class="control-label">Devise</label>
                            <div ng-controller="CurrencyController">
                                <select name="data[Facture][devise]" id="devise" class="form-control">
                                    <option value="">Choisissez la devise</option>
                                    <option value="{{c.code}}" ng-repeat="c in currency">{{c.symbol_native}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="acompte" class="control-label">Acompte</label>
                            <?php echo $this->Form->input('Facture.acompte', array('class' => 'form-control', 'id' => 'acompte', 'type' => 'text', 'ng-model' => 'acompte', 'autocomplete' => "off")) ?>
                        </div>
                    </div>
                    <div class="dci-form-column" style="position: absolute;">
                        <div class="form-group">
                            <label for="typepaiement" class="control-label">Type paiement</label>
                            <?php echo $this->Form->input('Facture.typepaiement', array('class' => 'form-control', 'id' => 'typepaiement', 'style' => 'padding: 0 0 0 10px;', 'options' => array('Carte bancaire' => 'Carte bancaire', 'Espèse' => 'Espèce', 'Chèque' => 'Chèque'), 'empty' => 'Choisissez le type de paiement', 'ng-model="typepaiement"')); ?>
                        </div>
                        <div class="carte-banque" style="display: none;">
                            <div class="form-group">
                                <label for="numcarte" class="control-label">Numéro de la carte</label>
                                <?php echo $this->Form->input('Facture.numcarte', array('class' => 'form-control carte-banque', 'id' => 'numcarte', 'placeholder' => 'Rensigner les 13 chiffres', 'ng-model' => 'numcarte', 'type' => 'text')); ?>
                            </div>
                            <div class="form-group">
                                <label for="expriration" class="control-label">Expiration</label>
                                <?php echo $this->Form->input('Facture.expiration', array('class' => 'form-control datepickerexp carte-banque', 'id' => 'expiration', 'type' => 'text', 'style' => 'cursor:text;background: #fff;', 'ng-model' => 'expiration')); ?>
                            </div>
                            <div class="form-group">
                                <label for="cryptogramme" class="control-label">Cryptogramme</label>
                                <?php echo $this->Form->input('Facture.cryptogramme', array('class' => 'form-control carte-banque', 'id' => 'cryptogramme', 'type' => 'text', 'placeholder' => 'Resigner les 3 chiffres', 'ng-model' => 'cryptogramme')); ?>
                            </div>
                        </div>
                        <div class="cheque" style="display: none;">
                            <div class="form-group">
                                <label for="numcheque" class="control-label">Numéro du cheque</label>
                                <?php echo $this->Form->input('Facture.numcheque', array('class' => 'form-control cheque', 'id' => 'numcheque', 'type' => 'text', 'placeholder' => 'Resigner les 7 chiffres', 'ng-model' => 'numcheque')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------------------ /END FORM 3 : FACTURE ------------------------------------->
                <div class="tab-pane" id="tab4">
                    <h3 class="block" style="border-bottom: 1px solid #e7e7e7;padding-bottom: 20px;">Confirmer l'admission</h3>
                    <!------------------------------------ DETAIL DOSSIER ADMISSION ----------------------------------->
                    <div class="tools">
                        <a href="#" class="label label-info" onclick="window.print();"><i class="fa fa-print"></i> Imprimer</a>
                        <a href="#" class="label label-info" onclick="pdf();"><i class="fa fa-file-pdf-o"></i> Exporter PDF</a>
                    </div>
                    <!--                    <div style="margin-top: 30px;">
                                            <h4 style="padding-bottom: 5px;" class="factprint">Facturation</h4>
                                        </div>-->
                    <div id="pdf" style="  padding-top: 20px;">
                        <table class="dci-form-column facture">
                            <tr>
                                <td>
                                    <p>Nom et prénom : <span id="pr">{{prenom}}</span> &nbsp;<span id="no">{{nom}}</span></span></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Adresse : <span id="adr">{{adresse}}</span></p>
                                </td>
                            </tr>
                            <td>
                                <p>Téléphone : <span id="phone">{{tel}}</span></p>
                            </td>
                        </table>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 400px;">Désigantion</th>
                                    <th>Prix Unitaire</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="desgcof">{{designation}}</td>
                                    <td>{{prixu}}</td>
                                    <td>{{montant}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>TVA 18%</th>
                                    <td>{{(montant * 18) / 100}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Timbre Fiscal</th>
                                    <td>0.500</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Total TTC</th>
                                    <td>{{ (((montant * 18) / 100) * 1 + montant * 1 + 0.500 * 1)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="dci-form-column facture">
                            <tr>
                                <td>
                                    <p>Acompte : {{acompte}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Type de paiement : {{typepaiement}}</p>
                                </td>
                            </tr>
                            <td>
                                <p id="devise"></p>
                            </td>
                        </table>
                    </div>
                </div>
            </div>
            <!------------------------------------ /END DETAIL DOSSIER ADMISSION ------------------------------------->
        </div>
        <!------------------------------------ BUTTONS NEXT, PREV, DONE ------------------------------------->
        <div class="pager wizard row">
            <div class="col-md-12" style="border-top: 1px solid #e7e7e7;">
                <div class="col-md-offset-3 col-md-9">
                    <ul class="pager">
                        <li class="previous">
                            <a href="#" class="dci-btn-danger" accesskey="p" style="">Retour</a>
                        </li>
                        <li class="last" style="display:none;">
                            <?php echo $this->Form->submit('Terminer', array('class' => 'btn btn-success', 'style' => 'position: absolute;left: 100px;margin-left: 72px;width: 150px;height: 42px;', 'div' => false)); ?>    
                        </li>
                        <li class="next">
                            <a href="#" class="dci-btn-primary next" accesskey="n" style="position: absolute;left: 100px;margin-left: 72px;">Suivant</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!------------------------------------ /END BUTTONS NEXT, PREV, DONE ------------------------------------->
    </div>
    <?php echo $this->Form->end(); ?>
<?php elseif ($this->Session->read('group.Group.name') === "pharmacien"): ?>
    <?php $this->Html->scriptStart(array('inline' => false)); ?>
    document.location.href = '<?php echo $this->Html->url(array('controller' => 'stocks', 'action' => 'index', 'home' => true)); ?>';
    <?php $this->Html->scriptEnd(); ?>
<?php endif; ?>
<!--------------------------------------  Modal  ----------------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestion de stock</h4>
            </div>
            <div class="modal-body clearfix">
                <?php
                echo $this->Form->create('Stock', array('inputDefaults' =>
                    array('div' => false, 'label' => false), 'class' => 'form-horizontal', 'url' => array('controller' => 'pages', 'action' => 'modifier_stock')));
                ?>
                <div class="form-group">
                    <label for="username" class="control-label">Nom d'utilisateur&nbsp;&ast;</label>
                    <?php echo $this->Form->input('User.username', array('class' => 'form-control', 'id' => 'username', 'style' => 'padding: 0 0 0 10px;', 'required' => true, 'placeholder' => 'ex: d01med', 'title' => 'Ce champs est obligatoire. Il doit contenir suite de lettre et de chiffre')); ?>
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

<?php
//JsPdf
echo $this->Html->script('jsPdf/jspdf.min');
//echo $this->Html->script('jsPdf/from-html');
echo $this->Html->script('jsPdf/FileSaver.min');
?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
function pdf() {
var doc = new jsPDF("p", "mm", "a4");
doc.setFontSize(12);
doc.text(10, 10, $("#pdf").text());
doc.output('dataurlnewwindow', 'facture.pdf');
}
<?php echo $this->Html->scriptEnd(); ?>