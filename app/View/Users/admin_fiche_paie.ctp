<div class="row">
    <div class="container">
        <div class="col-lg-12" style="margin-top: 30px;">
            <div class="col-lg-6">
                <?php echo $this->Html->image('logo-dci.png', array('style' => 'width:120px;')); ?>
                <blockquote style="margin-top: 10px;">
                    <p><strong>Adresse</strong> : <?php echo $user['User']['adresse']; ?></p>
                    <p><strong>Tél</strong> : <?php echo $user['User']['phone']; ?></p>
                </blockquote>
            </div>
            <div class="col-lg-6" style="margin-top: 140px;">
                <blockquote class="pull-right" style="text-align: left;"> 
                    <p><strong>Nom et prénom :</strong> <?php echo $user['User']['nom'] . ' ' . $user['User']['prenom']; ?></p>
                    <p><strong>Fonction :</strong> <?php echo $group['Group']['name']; ?></p>
                </blockquote>
            </div>
        </div>
        <table class="table table-bordered table-condensed table-hover table-striped table-responsive">
            <thead>
            <th>Désignation</th>
            <th>Tâche</th>
            <th>Salaire</th>
            <th>Primes</th>
            <th>Retenues</th>
            </thead>
            <tbody>
                <tr>
                    <td>Salaire brut</td>
                    <td><?php echo $poste['Poste']['nom']; ?></td>
                    <td><?php echo $poste['Poste']['salaire']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prime</td>
                    <td>Prime de déplacement </td>
                    <td></td>
                    <td>50</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;font-weight: bold;font-size: 20px;">Total</td>
                    <td><?php echo $poste['Poste']['salaire'] + 50; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>