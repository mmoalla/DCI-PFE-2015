<style type="text/css">
    #allreclam:hover{
        background-color: #DCDEDF;
    }
</style>
<?php if ($this->Session->read('group.Group.name') == "administration"): ?>
    <div class="row">
        <div class="container">
            <h1><i class="fa fa-area-chart"></i> Statistiques</h1><hr>
            <div class="col-lg-12" style="margin-bottom: 20px;">
                <div class="col-lg-3">
                    <div class="statpatient">
                        <div class="statpt-visual"><i class="fa fa-user"></i></div>
                        <div class="statpt-detail">
                            <span class="nombre" id="patient"><?php echo $patientct; ?></span><br>
                            <span class="text">Patient(s) admis</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="statpatient">
                        <div class="statpt-visual"><i class="fa fa-bed"></i></div>
                        <div class="statpt-detail">
                            <span class="nombre" style="right: 25px;" id="chambre"><?php echo $chambrect; ?></span><br>
                            <span class="text">Chambres</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="statpatient">
                        <div class="statpt-visual"><i class="fa fa-sign-in"></i></div>
                        <div class="statpt-detail">
                            <span class="nombre" style="right: 25px;" id="connect"></span><br>
                            <span class="text">Connecté(s)</span>
                        </div>
                    </div>
                </div>      
            </div>
            <div class="col-lg-12" style="padding: 0;">                    
                <div class="panel panel-primary">
                    <div class="panel panel-heading" style="border-radius: 3px 3px 0 0;">
                        <h4 style="text-align: center;"><i class="fa fa-line-chart"></i> Bénéfice de l'hôpital par jour</h4>
                    </div>
                    <div class="panel panel-body">
                        <div id="dci_chart_benefice" style="width: 100%;height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="padding: 0;">
                <div class="col-lg-8" style="padding-left: 0; padding-right: 15px;">
                    <div class="panel panel-primary">
                        <div class="panel panel-heading" style="border-radius: 3px 3px 0 0;">
                            <h4 style="text-align: center;"><i class="fa fa-pie-chart"></i> Pourcentage du personnel par sexe</h4>
                        </div>
                        <div class="panel panel-body" style="height: 300px;-webkit-box-shadow: none;box-shadow: none;padding: 0;">
                            <div id="dci_chart_sexe" style="width: 100%;height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="padding: 0;">
                    <div class="panel panel-primary" style="height: 405px;">
                    <div class="panel panel-heading" style="border-radius: 3px 3px 0 0;">
                        <h4 style="text-align: center;"><i class="fa fa-users"></i> Utilisateurs connectés</h4>
                    </div>
                    <div class="panel panel-body" ng-controller="ListConnecterController">
                        <ul class="statctx" ng-repeat="ctx in connecter">
                            <li><span style="font-weight: bold;margin-right: 3px;">{{ctx.User.prenom}} {{ctx.User.nom}}</span> <span id="moment" class="label label-info"> {{ctx.User.time_login}} </span></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($this->Session->read('group.Group.name') == "technique"): ?>
    <div class="row" style="margin-top: 30px;">
        <div class="container">
            <?php if(!empty($reclamations)): ?>
                <div style="font-size: 20px;font-weight: bold;margin-bottom: 20px;"><i style="top: 4px;margin-right: 5px;" class="fa fa-info-circle"> </i> Clique sur la réclamation non résolue pour la résoudre</div>
                <?php foreach ($reclamations as $reclamation): $reclamation = $reclamation['Reclamation']; ?>
                    <?php if($reclamation['status'] == '0'): ?>
                        <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'admin_view_reaclamation', $reclamation['_id'])); ?>" style="font-size: 20px;text-decoration: none;color: #000;">
                            <div class="well" id="allreclam" style="position: relative"> 
                                <span><?php echo $reclamation['nom']; ?></span>
                                <span style="position: absolute;right: 20px;"><span style="margin-right: 20px;"><?php echo $reclamation['created'];  ?></span> <?php echo $reclamation['status'] == 0 ? '<span class="label label-danger">Non résolue</span>' : '<span class="label label-info">Résolue</span>'; ?></span>       
                            </div>
                        </a>
                    <?php elseif($reclamation['status'] == '1'): ?>
                        <div class="well" style="position: relative;font-size: 20px;"> 
                            <span><?php echo $reclamation['nom']; ?></span>
                            <span style="position: absolute;right: 20px;"><span style="margin-right: 20px;"><?php echo $reclamation['created'];  ?></span> <?php echo $reclamation['status'] == 0 ? '<span class="label label-danger">Non résolue</span>' : '<span class="label label-info">Résolue</span>'; ?></span>       
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="well" style="font-size: 20px;text-align: center;font-weight: bold;">Pas de réclamation pour aujourd'hui <?php echo $this->Html->image('smile.png'); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php echo $this->Html->script('amcharts/amcharts'); ?>
<?php echo $this->Html->script('amcharts/serial'); ?>
<?php echo $this->Html->script('amcharts/pie'); ?>
<?php echo $this->Html->script('amcharts/themes/light'); ?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
var sexecounthomme = <?php echo $sexecthomme; ?>;
var sexecountfemme = <?php echo $sexectfemme; ?>;
var chart = AmCharts.makeChart("dci_chart_sexe",{
    "type"  :   "pie",
    "theme" :   "light",
    "dataProvider": [{
        "Sexe": "Homme",
        "Nombre": sexecounthomme
    },
    {
        "Sexe": "Femme",
        "Nombre": sexecountfemme
    }],
    "valueField": "Nombre",
    "titleField": "Sexe"
});
$.getJSON("http://localhost/DCI/pages/stat_benefice.json", function (data) {
    if(data.length != 0){
        var cData = [];
        var datas = [];
        datas = JSON.stringify(data);
        for (var i = 0; i < data.length; i++) {
            if(datas[i]){
                var dataObject = {
                    "date": data[i].Facture._id.year + "-" + data[i].Facture._id.month + "-" +  data[i].Facture._id.day,
                    "value": data[i].Facture.montant
                };
                cData.push(dataObject);
            }
        }
        var chart = AmCharts.makeChart("dci_chart_benefice", {
            "type": "serial",
            "theme": "light",
            "valueAxes": [{
                "id":"v1",
                "axisAlpha": 0,
                "position": "left",
                "title":"Bénéfice"
            }],
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "title": "red line",
                "useLineColorForBulletBorder": true,
                "valueField": "value"
            }],
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "dashLength": 1,
                "minorGridEnabled": true,
                "position": "bottom",
                "title": "date"
            },
            "dataProvider": cData
        });
    }
});
/*setInterval(function(){
    $.ajax({
        url : '<?php echo $this->Html->url(array('controller'=>'users','action'=>'nbr_connecter','admin'=>false),true); ?>',
        success : function(response){
            $("#connect").html(response);
        }
    });            
},3000);*/
<?php echo $this->Html->scriptEnd(); ?>
<style type="text/css">
    #dci_chart_sexe .amcharts-chart-div{
        top: -100px;
        overflow:hidden;
        position:relative;
        text-align:left;
        width:1106px;
        height:400px;
    }
</style>
