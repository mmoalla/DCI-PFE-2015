<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if ($this->Session->read('group.Group.name') == "administration"): ?>
            <a class="navbar-brand" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_home')); ?>"><i class="fa fa-home"></i> Administration</a>
            <?php elseif ($this->Session->read('group.Group.name') == "technique"): ?>
                <a class="navbar-brand" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_home')); ?>"><i class="fa fa-home"></i> Service Technique</a>
            <?php endif; ?>
        </div>
        <div class="navbar-collapse collapse navbar-inverse-collapse">
            <?php if ($this->Session->read('group.Group.name') == "administration"): ?>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Gestion RH<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'admin_index')); ?>"><i class="fa fa-users"></i> Gestion personnel</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_presence')); ?>"><i class="fa fa-check"></i> Gestion Présence</a></li>
<!--                            <li class="divider"></li>-->
<!--                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'admin_paie')); ?>"><i class="fa fa-money"></i> Gestion Paie</a>
                            </li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'chambres', 'action' => 'admin_index')); ?>"><i class="fa fa-bed"></i> Chambre</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_list_trace')); ?>"><i class="fa fa-history"></i> Historique activité</a>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right notif" id="notif">
                <?php if ($this->Session->read('group.Group.name') == "technique"): ?>
                    <li style="font-size: 20px;">
                        <a href="#" id="dci-globe" onclick="$('#notif-number').hide();" class="dropdown-toggle" data-toggle="dropdown" style="padding: 19px;">
                            <i class="fa fa-bell"></i>
                            <span class="notif-number" id="notif-number"></span>
                        </a>
                        <div class="panel panel-default dropdown-menu" style="padding: 0;width: 300px;">
                            <div class="panel-heading" style="font-size: 20px;text-align: center;">Réclamations</div>
                            <div class="panel-body" style="padding: 15px 0;">
                                <notif id="notif-menu" class="notif-menu"></notif>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php
                    echo $this->Html->url(array(
                        'controller' => 'users',
                        'action' => 'logout', 'admin' => false,
                    ));
                    ?>" style="line-height: 40px;"><i class="fa fa-sign-out"></i> Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<style type="text/css">
    .reclam{color: #000;}
    .reclam:hover{color: #fff;}
    .reclam > span.reclamnom{font-size: 20px;}
</style>
<?php echo $this->Html->script('moment/moment.min'); ?>
<?php echo $this->Html->script('moment/fr'); ?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
    var test = sessionStorage.setItem('issetNotif', 'notDone');
    var countNotif = <?php echo $countNotif; ?>;
    setInterval(function () {
        jQuery.ajax({
            url: 'http://localhost/DCI/admin/allnotif.json',
            success: function (response) {
                countNotif = response;
                if (response > 0) {
                    $('#notif-number').html(response);
                    if (response > <?php echo $countNotif; ?>) {
                        if (sessionStorage.getItem('issetNotif') === 'notDone') {
                            $('#notif-number').append('<?php echo $this->Html->media(array('ping.mp3', array('src' => 'ping.ogg', 'type' => "video/ogg; codecs='theora, vorbis'")), array('autoplay')); ?>');
                            sessionStorage.setItem('issetNotif', 'done');
                        }
                    }
                } else {
                    $('#notif-number').hide();
                }
            }
        });
    }, 2000);
            
    setInterval(function () {
        jQuery.ajax({
            url: 'http://localhost/DCI/admin/allnotif/1.json',
            success: function (resp) {
                var items = '';
                $.each(resp, function (index, value) {
                    items = items + '<li><a class="reclam" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'view_reaclamation')); ?>/' + value.Reclamation._id + '"><span class="reclamnom">' + value.Reclamation.nom + ' </span><span class="label label-info" style="font-size: 12px;margin-left: 5px;">' + moment(value.Reclamation.created).fromNow() + '</span></a></li>';
                });
                $("#notif-menu").html(items);
            }
        });
    }, 2000);
<?php echo $this->Html->scriptEnd(); ?>