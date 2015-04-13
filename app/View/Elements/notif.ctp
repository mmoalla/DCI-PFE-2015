<?php if(isset($type) && $type == 'error'): ?>
<div class="dci-alert alert alert-dismissable <?php echo 'alert-danger'; ?> " style="font-size: 16px;z-index: 999;width: 250px;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p><i class="fa fa-times-circle">&nbsp;</i><?php echo $message ?></p>
</div>
<?php elseif(isset($type) && $type == 'success'): ?>
<div class="dci-alert alert alert-dismissable <?php echo 'alert-success'; ?>" style="font-size: 16px;z-index: 999;width: 250px;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p><i class="fa fa-check-circle">&nbsp;</i><?php echo $message ?></p>
</div>
<?php endif; ?>