<?php $this->Html->addCrumb('Planning', array('controller' => 'consultations', 'action' => 'index')); ?>
<div id="dci-calendar" style="display: block;">
    <div class="page-header" style="margin: 0;border: none;">
        <h1>Planning Mensuel</h1>
    </div>
    <div class="dci-hr"></div>
    <div class="alert alert-info" style="margin-top: 30px;font-size: 20px;">
        <i class="fa fa-info-circle">&nbsp;</i> Clique sur un planning pour voir ses détails
    </div>
    <?php
    require ('date.php');
    $date = new Date();
    $y = date('Y');
    $dates = $date->getAll($y);
    ?>
    <!------- affichage de l'anneé courante -------->
    <span style="font-size: 20px;position: relative;top: -10px;">Année : <?php echo $y; ?></span>
    <!------- affichage des mois de l'anneé courante -------->
    <div class="dci-months">
        <?php foreach ($date->months as $id => $m): ?>
            <div class="month"><a href="#" class="label label-default" id="linkMonth<?php echo $id + 1; ?>"><?php echo utf8_encode(substr(utf8_decode($m), 0, 3)); ?></a></div>
        <?php endforeach; ?>
    </div>
    <div class="clear"></div>
    <?php $dates = current($dates); ?>
    <?php foreach ($dates as $m => $days): ?>
        <!------- affichage du calendrier du mois courant -------->
        <div class="dci-month" id="month<?php echo $m; ?>">
            <table class="dci-table">
                <thead>
                    <tr>
                        <?php foreach ($date->days as $d): ?>
                            <th><?php echo substr($d, 0, 3); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $end = end($days);
                        foreach ($days as $d => $w):
                            ?>
                            <?php if ($d == 1 && $w != 1): ?>
                                <td colspan="<?php echo $w - 1; ?>" class="padding"></td>
                            <?php endif; ?>
                            <td>
                                <div class="day">
                                    <div class="number"><?php echo $d; ?></div>
                                    <?php if ($this->Session->read('group.Group.name') == 'bureau admission'): ?>
                                        <?php
                                        foreach ($consultations as $consultation):
                                            $consultation = $consultation['Consultation'];
                                            $time = date('Y-m-d', strtotime("$y-$m-$d"));
                                            ?>
                                            <?php if (isset($consultation) && $consultation['datedebut'] === $time && !empty($consultation)): ?>
                                                <div class="content label label-info">
                                                    <a href="#detail" onclick="detailAction('<?php echo $consultation['_id']; ?>', 'consultations');" data-toggle="modal" data-target=".bs-example-modal-lg" style="outline: none;text-transform: uppercase;" id="tootltip" data-toggle="tooltip" title="" data-original-title="Clique ici pour voir les détails"><?php echo $consultation['motif']; ?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php elseif ($this->Session->read('group.Group.name') == 'docteur'): ?>
                                        <?php
                                        foreach ($rdvs as $rdv):
                                            $rdv = $rdv['Consultation'];
                                            $time = date('Y-m-d', strtotime("$y-$m-$d"));
                                            ?>
                                            <?php if (isset($rdv) && $rdv['datedebut'] === $time && !empty($rdv)): ?>
                                                <div class="content label label-info">
                                                    <a href="#detail" onclick="detailAction('<?php echo $rdv['_id']; ?>', 'consultations');" data-toggle="modal" data-target=".bs-example-modal-lg" style="outline: none;text-transform: uppercase;" id="tootltip" data-toggle="tooltip" title="" data-original-title="Clique ici pour voir les détails"><?php echo $rdv['motif']; ?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <?php if ($w == 7): ?>
                            </tr><tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($end != 7): ?>
                            <td colspan="<?php echo 7 - $end; ?>" class="padding"></td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<!---------------------- MODAL DETAIL-------------------------->
<div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-backdrop fade in" style="height: 100%;"></div>
    <div class="modal-dialog modal-lg" style="margin-top: 225px;">
        <div class="modal-content" id="detail_ajax">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php $this->Html->script("xhr", array('inline' => false)); ?>