<?php $this->layout = false; ?>
<!------------------------------------------ TABS LIST ------------------------------------------->
<ul id="myTab" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#infop" id="infop-tab" aria-controls="infop" role="tab" data-toggle="tab" aria-expanded="true">Informations du patient</a></li>
    <li role="presentation"><a href="#cons" id="rdv-tab" aria-controls="infordv" role="tab" data-toggle="tab"  aria-expanded="true">Consultation</a></li>
    <?php if ($this->Session->read('group.Group.name') == "docteur"): ?>
        <li role="presentation"><a href="#medoc" id="medoc-tab" aria-controls="infordv" role="tab" data-toggle="tab"  aria-expanded="true">Médicaments</a></li>
        <li role="presentation"><a href="#pro" id="pro-tab" aria-controls="infordv" role="tab" data-toggle="tab"  aria-expanded="true">Profilage</a></li>
    <?php endif; ?>
    <?php if ($this->Session->read('group.Group.name') == "bureau admission"): ?>
        <li role="presentation"><a href="#fact" id="ante-tab" aria-controls="infordv" role="tab" data-toggle="tab"  aria-expanded="true">Factures</a></li>
    <?php endif; ?>
</ul>
<!------------------------------------------- Tab Info Patient ------------------------------------------->
<div class="tab-content" id="myTabContent" style="padding: 30px 0px;">
    <div role="tabpanel" class="tab-pane fade active in" id="infop" aria-labelledby="infop-tab">
        <div class="col-lg-12">
            <div class="col-lg-5">
                <?php echo $this->Html->image("avatars/" . $patient['Patient']['avatar'], array('class' => 'thumbnail', 'style' => 'max-width: 100%;
width: 150px;')); ?>
            </div>
            <div class="col-lg-4">
                <h4 style="font-size: 50px;margin-top: 60px;margin-left: -200px;margin-bottom: 25px;"><?php echo$patient['Patient']['reference'] . ' : ' . $patient['Patient']['prenom'] . ' ' . $patient['Patient']['nom']; ?></h4>
                <div class="label label-info" style="font-size: 18px;margin-left: -85px;">CNSS : <?php echo $patient['Patient']['numss']; ?></div>
            </div>
            <?php if ($this->Session->read('group.Group.name') == 'bureau admission'): ?>
                <div class="col-lg-3" style="margin-top: 70px;">
                    <a href="#modifier" onclick="modifPtAction('<?php echo $patient['Patient']['_id']; ?>', 'patients');" class="btn btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i> Modifier</a>
                </div> 
            <?php endif; ?>
        </div>
        <input type="hidden" value="<?php echo $patient['Patient']['_id']; ?>" id="PatientId">
        <div class="col-lg-12 well" style="margin-top: 40px;font-size: 20px;">
            <div class="col-lg-4">
                <p><i class="fa fa-calendar-o"></i> Date de naissance : <?php echo $patient['Patient']['birthdate']; ?></p>
                <p>Sexe : <?php echo $patient['Patient']['sexe']; ?></p>
                <p><i class="fa fa-globe"></i> Nationnalité : <?php echo $patient['Patient']['nationalite']; ?></p>
                <p><i class="fa fa-briefcase"></i> Profession : <?php echo $patient['Patient']['job']; ?></p>
            </div>
            <div class="col-lg-4">
                <p><i class="fa fa-map-marker"></i> Adresse : <?php echo $patient['Patient']['adresse']; ?></p>
                <p><i class="fa fa-globe"></i> ville : <?php echo $patient['Patient']['ville']; ?></p>
                <p><i class="fa fa-phone"></i> Téléphonee : <?php echo $patient['Patient']['tel']; ?></p>
                <p><i class="fa fa-at"></i> Email : <?php echo $patient['Patient']['email']; ?></p>                      
            </div>
            <div class="col-lg-4">
                <p>Age : <?php echo $patient['Patient']['age']; ?></p>
                <p>Taille : <?php echo $patient['Patient']['taille']; ?></p>
                <p>Poids : <?php echo $patient['Patient']['poids']; ?></p>
                <p><i class="fa fa-heart"></i> Groupe sanguin : <?php echo $patient['Patient']['blood']; ?></p>
            </div> 
        </div>
    </div>
    <!------------------------------------------- Tab Consultation ------------------------------------------->
    <div role="tabpanel" class="tab-pane col-lg-12" id="cons" style="font-size: 20px;">
        <div role="tabpanel" class="tab-pane col-lg-12" id="cons" style="font-size: 20px;">
            <?php if ($this->Session->read('group.Group.name') === "docteur"): ?>
                <?php foreach ($consults as $consult): ?>
                    <?php if (!empty($consults)): ?>
                        <div class="col-lg-12 well">
                            <h1>Motif de consulattion : <?php echo $consult['Consultation']['motif']; ?></h1>
                            <div class="col-lg-6">
                                <p style="text-align: justify;">
                                    <span>Détails de consulattion :
                                        <?php
                                        if (!empty($consult['Consultation']['detail'])):
                                            echo '<br>' . $consult['Consultation']['detail'];
                                        else:
                                            echo 'Rien';
                                        endif;
                                        ?>
                                    </span>
                                </p>
                                <p>Date d'entrée : <?php echo $consult['Consultation']['datedebut']; ?></p>
                                <p>Date de sortie : <?php echo $consult['Consultation']['datefin']; ?></p>
                            </div>
                            <div class="col-lg-6">
                                <p>Heure de consultation : <?php echo $consult['Consultation']['heure']; ?></p>
                                <?php foreach ($doctors as $doctor): ?>
                                    <p>Médecin traitant : <?php echo $doctor['User']['prenom'] . ' ' . $doctor['User']['nom']; ?></p>
                                <?php endforeach; ?>
                                <?php foreach ($chbres as $chambre): ?>
                                    <?php if (!empty($chambre)): ?>
                                        <p>N° de chambre : <?php echo $chambre['Chambre']['numero']; ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info" style="text-align: center;font-size: 20px;font-weight: bold;"><i class="fa fa-info-circle"></i> Aucune consultation à venir </div>
                    <?php endif; ?>
                <?php endforeach; ?> 
            <?php elseif ($this->Session->read('group.Group.name') === "bureau admission"): ?>
                <?php foreach ($consultes as $consult): ?>
                    <div class="well col-lg-12">
                        <h1>Motif de consulattion : <?php echo $consult['Consultation']['motif']; ?></h1>
                        <div class="col-lg-6">
                            <p style="text-align: justify;">
                                <span>Détails de consulattion :
                                    <br><p style="margin-left: 50px;"><?php echo $consult['Consultation']['detail']; ?></p>
                                </span>
                            </p>
                            <p>Date d'entrée : <?php echo $consult['Consultation']['datedebut']; ?></p>
                            <p>Date de sortie : <?php echo $consult['Consultation']['datefin']; ?></p>
                        </div>
                        <div class="col-lg-6">
                            <p>Heure de consultation : <?php echo $consult['Consultation']['heure']; ?></p>
                            <?php foreach ($doctors as $doctor): ?>
                                <p>Médecin traitant : <?php echo $doctor['User']['prenom'] . ' ' . $doctor['User']['nom']; ?></p>
                            <?php endforeach; ?>
                            <?php foreach ($chbres as $chambre): ?>
                                <?php if (!empty($chambre)): ?>
                                    <p>N° de chambre : <?php echo $chambre['Chambre']['numero']; ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?> 
            <?php endif; ?>
        </div>
    </div>
    <!------------------------------------------- Tab Médicament ------------------------------------------->
    <div role="tabpanel" class="tab-pane" id="medoc">
        <div class="col-lg-5">
            <div class="alert alert-danger" id="alertMedoc" style="display: none;"><i class="fa fa-times-circle"></i> Vous devez remplir tout les champs</div>
            <a href="#" class="btn btn-default" id="prescription" style="margin-bottom: 10px;"><i class="fa fa-list"></i> Prescrire un médicament</a>
            <div class="dci-drug" id="dci-drug">
                <form class="form-horizontal" action="/DCI/home/prescriptions/add">
                    <div class="dci-drug-result" id="drug-result">
                        <label for="posologie" class="control-label">Selectionner les médicaments&nbsp;&ast;</label>
                        <select class="dci-drug-list form-control" id="listeMedoc" data-placeholder="Choose a Category" tabindex="1" required>
                            <!---- Liste des médicaments ---->
                        </select>
                    </div>
                    <div class="prescription" style="margin-left: 15px;margin-right: 15px;">
                        <div class="form-group">
                            <label for="posologie" class="control-label">Posologie&nbsp;&ast;</label>
                            <input type="text" class="form-control" name="data[posologie]" id="posologie" required/>
                        </div>
                        <div class="form-group" style="margin-bottom: -10px;">
                            <label for="duree" class="control-label">Durée&nbsp;&ast;</label>
                            <input type="text" class="form-control" name="data[duree]" id="duree" required/>
                            <div class="input-group-addon" style="width: 10px;position: relative;top: -43px;left: 390px;padding: 14px 10px;">jours</div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm" id="addMedoc"><i class="fa fa-plus"></i> Ajouter médicament</button>
                            <button id="submitMedoc" class="btn btn-success btn-sm pull-right" disabled><i class="fa fa-check"></i> Confirmer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <a href="#" class="btn btn-info" id="voirplus" style="margin-bottom: 10px;position: absolute;right: 30px;"><i class="fa fa-plus"></i> Voir plus</a>
        <div class="col-lg-7" id="ordonnance" style="display: none;background-color: #f1f1f1;padding-top: 20px;">
            <div class="certificat" id="certificat" style="margin-bottom: 20px;position: relative;text-align: center;">
                <span style="width: 215px;text-align: center;display: inline-block;position: relative;top: 25px;margin-right: 60px;">République Tunisienne<br>Ministère de la santé publique<br>Hôpital de Tunis</span>
                <span style="width: 125px;text-align: center;display: inline-block;"><?php echo $this->Html->image('logo-dci.png', array('style' => 'max-width: 100%;width:125px;height:auto;')); ?></span>
                <span style="width: 350px;text-align: center;display: inline-block;position: relative;top: 25px;margin-left: 20px;">Docteur <?php echo $this->Session->read('Auth.User.prenom') . ' ' . $this->Session->read('Auth.User.nom'); ?><br><?php echo $this->Session->read('Auth.User.formation'); ?><br>Spécialiste en <?php echo $spec['Service']['nom'] ?> </span>
                <span style="position: absolute;right: -5px;top: -10px;"><a href="#" class="btn btn-default btn-xs" onclick="window.print();"><i class="fa fa-print"></i> Imprimer</a></span><br>
                <div style="margin: 50px 0;">
                    <span style="position: relative;left: 190px;margin-top: 20px;font-size: 36px;font-weight: bold;margin-bottom: 30px;">Ordonnance</span>
                    <span style="width: 215px;position: relative;left: -225px;font-size: 20px;">Tunis le <?php echo date('Y-m-d'); ?></span>
                    <span style="width: 350px;position: relative;left: 66px;font-size: 20px;">Nom et prénom : <?php echo $patient['Patient']['nom'] . ' ' . $patient['Patient']['prenom']; ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="position: relative; font-size: 22px;">
            <div class="panel panel-default" id="medocdate">
                <div class="panel-body" id="medocnom">
                    <!-- liste des médicaments préscris par le docteur -->
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------------- Tab Profilage ------------------------------------------->
    <div role="tabpanel" class="tab-pane col-lg-12" id="pro" style="font-size: 20px;">
        <div class="alert alert-danger" id="alertExamen" style="display: none;"><i class="fa fa-times-circle"></i> Vous devez remplir tout les champs</div>
        <div class="col-lg-3">
            <form class="form-horizontal" action="/DCI/home/examens/add">
                <div class="form-group">
                    <label for="nom" class="control-label">Nom</label>
                    <select class="form-control" id="listeExamen" data-placeholder="Choisissez l'examen" tabindex="1" required>
                        <!---- Liste des médicaments ---->
                    </select>
                </div>
                <div class="form-group">
                    <label for="dosage" class="control-label">Dosage</label>
                    <input type="text" class="form-control" name="data[dosage]" id="dosage" required/>
                </div>
                <div class="form-group">
                    <label for="dosage" class="control-label">Date</label>
                    <input type="text" class="form-control" name="data[date]" id="dateExam" required/>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" id="addExamen"><i class="fa fa-plus"></i> Ajouter examen</button>
                </div>
            </form>
        </div>
        <div class="col-lg-9">
            <div id="dci_chart_pro" style="width: 100%;height: 400px;"></div>
        </div>
    </div>
    <!------------------------------------------- Tab Facture ------------------------------------------->
    <?php if ($this->Session->read('group.Group.name') === "bureau admission"): ?>
        <?php foreach ($factures as $facture) : $facture = $facture['Facture']; ?>
            <div role="tabpanel" class="tab-pane col-lg-12 well" id="fact" style="font-size: 20px;">
                <h1>Facture n° <?php echo $facture['numero']; ?></h1>
                <p>Désignation : <?php echo $facture['designation']; ?></p>
                <p>Montant : <?php echo $facture['montant']; ?> TND</p>
                <p>Devise : <?php echo $facture['devise']; ?></p>
                <p>Paiement : <?php echo $facture['typepaiement']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!----------------------------- MODAL DE MODIFICATION -------------------------------->
<div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-backdrop fade in" style="height: 130.2%;"></div>
    <div class="modal-dialog modal-lg" style="margin-top: 60px;">
        <div class="modal-content" id="modifPt_ajax">
            <!-- Contenue de modification -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php echo $this->Html->script('xhr'); ?>