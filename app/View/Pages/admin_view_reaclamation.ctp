<div class="row" style="margin-top: 30px;">
    <div class="container">
        <div style="font-size: 20px;font-weight: bold;margin-bottom: 20px;"><i style="top: 4px;margin-right: 5px;" class="fa fa-info-circle"> </i> Clique sur la case à cohcher pour résoudre la réclamation</div>    
        <div class="well" style="font-size: 20px;">
            <div style="position: relative;">
                <?php echo $rec['Reclamation']['nom']; ?>
                <div style="position: absolute;top: 0;right: 0;" id="resolue">
                    Resoudre&nbsp; 
                    <span class="rounded"></span>
                    <input type="checkbox" id="solve"/>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->scriptStart(array('inline'=>false)); ?>
    $(document).on('ready',function () {
        $("#solve").on('change', function () {
            $.ajax({
                url : '<?php echo $this->Html->url(array('controller'=>'pages', 'action'=>'update_notif', 'admin'=>true, $rec['Reclamation']['_id'])); ?>',
                type : 'PUT',
                success : function(result){
                    $(this).parent().parent().fadeOut();
                    if(result == 'success'){
                        $("#resolue").replaceWith("<span class='label label-info'>Résolue</span>");
                        window.location.href = "<?php echo $this->Html->url('http://localhost/DCI/admin'); ?>";
                    }
                }
            });
        });
    });
<?php echo $this->Html->scriptEnd(); ?>