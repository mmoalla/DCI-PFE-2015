<div class="row">
    <div class="container">
        <h1>Getion de la paie</h1><hr>
        <?php // debug($postespaies); ?>
        <div class="list-group" style="width: 700px;">
            <?php foreach ($userpaie as $up): ?>
                <?php foreach ($postepaie as $pp): ?>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading" style="display: inline-block;"><?php echo $up['User']['nom']; ?></h4>
                        <span class="list-group-item-text pull-right"><?php echo $pp['Poste']['salaire']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>