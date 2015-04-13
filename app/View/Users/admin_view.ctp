<div class="row">
    <div class="container">
        <h1><?php echo $group['Group']['name'] . ' ' . $user['User']['prenom'] . ' ' . $user['User']['nom']; ?></h1>
        <div class="well clearfix">
            <div class="col-lg-12">
                <div class="col-lg-7">
                    <p style="font-size: 20px;"><strong>Date de naissance :</strong> <?php echo $user['User']['birthdate']; ?></p>
                    <p style="font-size: 20px;"><strong>Téléphone :</strong> <?php echo $user['User']['phone']; ?></p>
                    <p style="font-size: 20px;"><strong>Adresse :</strong> <?php echo $user['User']['adresse']; ?></p>
                    <p style="font-size: 20px;"><strong>Email :</strong> <?php echo $user['User']['email']; ?></p>
                    <?php if (!empty($service)): ?>
                        <p style="font-size: 20px;"><strong>Service :</strong> <?php echo $service['Service']['nom']; ?></p>
                    <?php endif; ?>
                    <p style="font-size: 20px;"><strong>Poste :</strong> <?php echo $poste['Poste']['nom']; ?></p>
                    <p style="font-size: 20px;"><strong>Salaire :</strong> <?php echo $poste['Poste']['salaire']; ?></p>
                    <div style="font-size: 20px;"><strong>Formation :</strong><br> 
                        <ul><li><?php echo $user['User']['formation']; ?></li></ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="<?php echo $this->Html->url(array('action' => 'fiche_paie', $user['User']['_id'])); ?>" class="btn btn-primary" style="position: absolute;right: 0;"><i class="fa fa-file-text-o">&nbsp;</i>Fiche de paie</a>
                </div>
            </div>
        </div>
    </div>
</div>