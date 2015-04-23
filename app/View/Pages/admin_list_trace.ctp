<div class="row">
    <div class="container">
        <h1><i class="fa fa-history"></i> Historique des activités de l'hôpital</h1><hr>
        <?php
        if (file_exists(APP . 'tmp' . DS . 'logs' . DS . 'historique_dci.log')):
            $historique = file_get_contents(LOGS . 'historique_dci.log');
            $string = explode('.', $historique);
            ?>
            <?php foreach ($string as $history): ?>
                <p class="list-group" style="font-size: 20px;">
                    <?php
                    if (!empty($history)):
                        echo $history . ".";
                    endif;
                    ?>
                </p>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="alert alert-info" style="text-align: center;font-size: 30px;font-weight: bold">
                <i class="fa fa-info-circle"></i> Pas d'activité signalé dans cet hôpital
            </p>
        <?php endif; ?>
    </div>
</div>