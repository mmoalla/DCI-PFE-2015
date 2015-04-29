<?php $this->Html->css('../js/select2/select2', array('inline' => false)); ?>
<?php $this->Html->css('../js/select2/select2-metronic', array('inline' => false)); ?>
<?php echo $this->Html->script('underscore', array('inline' => false)); ?>
<?php $this->Html->addCrumb('Patient', array('controller' => 'patients', 'action' => 'index')); ?>
<div class="page-header" style="margin-bottom: 5px;border: none;">
    <h1>
        <?php echo __("Patients"); ?> 
        <input class="form-control" type="text" autocomplete="off" list="searchcomplete" id="search" type="search" placeholder="Recherche patient...." style="width: 300px;display: inline-block;position: absolute;top: 93px;margin-left: 20px;"/>
    </h1>
    <div id="ressearch" style="display: none;margin-left: 164px;margin-top: -9px;"></div>
    <div style="position: absolute;top: 105px;right: 520px;"><i class="fa fa-info-circle"></i>&nbsp;Rechercher un patient pour afficher son dossier complet</div>
</div><div class="dci-hr" style="margin-bottom: 15px;"></div>

<!------------------------ Nav tabs ---------------------------->
<?php if ($this->Session->read('group.Group.name') == 'docteur'): ?>
    <div role="tabpanel" id="p-pt" data-example-id="togglable-tabs" >
        <div class="dci-toggle-group clearfix">
            <?php if (!empty($malades)): ?>
                <ul class="pagination" style="margin: 0 0 10px 0;">
                    <?php
                    echo $this->Paginator->prev(__('Préc'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'style' => 'cursor: not-allowed;'));
                    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                    echo $this->Paginator->next(__('Suiv'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'style' => 'cursor: not-allowed;'));
                    ?>  
                </ul>
                <?php foreach ($malades as $malade): ?>
                    <div class="dci-group-item clearfix col-xs-12" style="margin-bottom: 10px;">
                        <div class="col-xs-4"><?php echo $this->Html->image('avatars/' . $malade['Patient']['avatar'], array('class' => 'thumbnail', 'style' => 'margin:0;max-width:100%;width: 150px;')); ?></div>
                        <div class="col-xs-4" style="margin-top: 15px;"><h1><?php echo $malade['Patient']['reference'] . ' : ' . $malade['Patient']['prenom'] . ' ' . $malade['Patient']['nom']; ?></h1></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="alert alert-info" style="text-align: center;font-size: 20px;font-weight: bold;">
                    Aucun patient ne vous ai affecté
                </p>
            <?php endif; ?>
        </div>
    </div>
<?php elseif ($this->Session->read('group.Group.name') == 'bureau admission'): ?>
    <div role="tabpanel" id="p-pt" data-example-id="togglable-tabs" >  
        <ul class="pagination" style="margin: 0 0 10px 0;">
            <?php
            echo $this->Paginator->prev(__('Prev'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'style' => 'cursor: not-allowed;'));
            echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
            echo $this->Paginator->next(__('Next'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a', 'style' => 'cursor: not-allowed;'));
            ?>  
        </ul>
        <div class="dci-toggle-group clearfix">
            <?php if (!empty($pts)): ?>
                <?php foreach ($pts as $pt): $pt = $pt['Patient']; ?>
                    <div class="dci-group-item clearfix col-xs-12" style="margin-bottom: 10px;">
                        <div class="col-xs-4"><?php echo $this->Html->image('avatars/' . $pt['avatar'], array('class' => 'thumbnail', 'style' => 'margin:0;max-width:100%;width: 150px;')); ?></div>
                        <div class="col-xs-4" style="margin-top: 15px;"><h1><?php echo $pt['reference'] . ' : ' . $pt['prenom'] . ' ' . $pt['nom']; ?></h1></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="alert alert-info" style="text-align: center;font-size: 20px;font-weight: bold;">Aucun patient n'est admis</p>
            <?php endif; ?>
        </div>
    </div>
    <br clear="both" />
<?php endif; ?>
<?php echo $this->Html->script('xhr', array('inline' => false)); ?>
<?php echo $this->Html->script('select2/select2.min', array('inline' => false)); ?>
<?php echo $this->Html->script('amcharts/amcharts', array('inline' => false)); ?>
<?php echo $this->Html->script('amcharts/serial', array('inline' => false)); ?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
var data = {};
/******************* MEDICAMENTS *******************/
jQuery().ready(function (){ 
    $('select').select2();
    var dataMedoc = [];
    var medoc, mid, pos, duree, pid, uid;
    $("#p-pt").on('click', '#prescription', function () {
        $("#medocdate").parent().hide();
        $("#ordonnance").show();
        $("#dci-drug").show();
        $.getJSON("http://localhost/DCI/patients/find_medoc.json", function (data) {
            $("#listeMedoc").append("<option>Selectionner un medicament</option>");
            $.each(data, function (index, value) {
                var med = "<option value='" + value.Medicament._id + "'>" + value.Medicament.nom_commercial + "</option>";
                $("#listeMedoc").append(med);
            });
        });
    });
    $('#p-pt').on('click', '#addMedoc', function (e) {
        e.preventDefault();
        medoc = $('#listeMedoc :selected').text();
        mid = $('#listeMedoc :selected').val();
        pos = $('#posologie').val();
        duree = $('#duree').val();
        pid = $("#PatientId").val();
        if(medoc === 'Selectionner un medicament' || pos === '' || duree === ''){
            $("#alertMedoc").show();
        } else{
            $("#alertMedoc").hide();
            $("#certificat").append("<p id='medic' style='font-size: 20px;margin-top: 10px;text-align: left;padding-left: 103px;' data-id='" + mid + "'>" + medoc + "&nbsp;&nbsp;&nbsp;" + pos + "&nbsp;&nbsp;&nbsp;pendant " + duree + " jours </p>");
            dataMedoc.push({"medicament_id": mid, "posologie": pos, "duree": duree});
            $("#submitMedoc").removeAttr("disabled");
            $('#certificat').on('click', '#medocRemove', function (e) {
                e.preventDefault();
                //console.log($(this).parent().children().attr('data-id'));            
            });
        }
        JSON.stringify(dataMedoc);
    });
    $('#p-pt').on('click', '#submitMedoc', function (e) {
        e.preventDefault();
        pid = $("#PatientId").val();
        uid = "<?php echo $this->Session->read('Auth.User._id'); ?>";
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'prescriptions', 'action' => 'add', 'home' => true), true); ?>",
            type: 'POST',
            data: {
                "MedicamentPrescription": dataMedoc,
                "Prescription": {"patient_id": pid, "user_id": uid}
            },
            success: function (data) {
                window.location.href = "<?php echo $this->Html->url(array('controller' => 'patients', 'action' => 'index', 'home' => true)) ?>";
            }
        });
        //$("#dci-drug").hide();
        //$("#ordonnance").hide();
    });
    $('#p-pt').on('click', '#medoc-tab', function (e) {
        $("#alertMedoc").hide();
        $("#dci-drug").hide();
        $("#ordonnance").hide();
        pid = $("#PatientId").val();
        $.getJSON("http://localhost/DCI/home/ordonnance-patient-" + pid + "-1.json", function (data) {
            if (data !== null) {
                $.each(data, function (index, value) {
                    var medcreated = "<span class='label label-info' style='display: block;position: absolute; top: 15px; right: 25px;'>" + new Date(value.Prescription.created).toJSON().substring(0, 10) + "</span>";
                    $("#medocdate").append(medcreated);
                    $.each(value.Medicament, function (i, v) {
                        var mednom = "<span style='display: block;'>" + v.nom_commercial + "</span>";
                        $("#medocnom").append(mednom);
                    });
                });
            } else {
                var resvide = "<div style='text-align: center;'><i class='glyphicon glyphicon-info-sign'></i> Aucun médicament préscris</div>";
                $("#medocnom").html(resvide);
            }
        });
    });
    $('#p-pt').on('click', '#voirplus', function (e) {
        pid = $("#PatientId").val();
        $.getJSON("http://localhost/DCI/home/ordonnance-patient-" + pid + "-0.json", function (data) {
            if (data !== null) {
                $.each(data, function (index, value) {
                    var created = new Date(value.Prescription.created).toJSON().substring(0, 10);
                    var medcreated = "<span class='label label-info' style='display: block;position: absolute; top: 15px; right: 25px;'>" + created + "</span>";
                    $("#medocdate span").replaceWith(medcreated);
                    $.each(value.Medicament, function (i, v) {
                        var nomMed = v.nom_commercial;
                        var mednom = "<span style='display: block;'>" + nomMed + "</span>";
                        $("#medocnom span").replaceWith(mednom);
                    });
                });
            }
        });
    });
    /******************* EXAMENS *******************/
    function chartProfile(){
        $.getJSON("http://localhost/DCI/home/examens/index.json", function (data) {
            var cData = [];
            for (var i = 0; i < data.length; i++) {
                var dataObject = {
                    "nom": data[i].Examen.nom,
                    "dosage": data[i].Examen.dosage,
                    "date": data[i].Examen.created
                };
                cData.push(dataObject);
                JSON.stringify(cData);
                var chart = AmCharts.makeChart("dci_chart_pro", {
                    "type": "serial",
                    "theme": "light",
                    "dataProvider": cData,
                    "balloon": {
                        "cornerRadius": 6
                    },
                    "valueAxes": [{
                        "title":"Dosage",
                        "dosage":"mm",
                        "axisAlpha": 1,
                        "position": "left"
                    }],
                    "graphs": [{
                        "bullet": "round",
			"labelText": "[[nom]]",
                        "valueField": "dosage",
			"labelPosition": "right",
                    }],
                    "categoryField": "date",
                    "categoryAxis": {
                        "parseDates": true,
                        "dashLength": 1,
                        "minorGridEnabled": true,
                        "position": "bottom",
                        "title": "date"
                    }
                });
            }
        });
    }
    $('#p-pt').on('click', '#pro-tab', function (e) {
        $("#alertExamen").hide();
        $.getJSON("<?php echo $this->Html->url('/js/jsons/Examen.json', true); ?>", function (data) {
            if (data !== null) {
                $("#listeExamen").append("<option>Selectionner un examen</option>");
                $.each(data, function (index, value) {
                    var exam = "<option>" + value.nom + "</option>";
                    $("#listeExamen").append(exam);
                });
            }
        });
        $('#dateExam').pickadate({
            monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
            clear: false,
            close: false,
            today: false,
            labelMonthNext: 'Mois suivant',
            labelMonthPrev: 'Mois précédent',
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            selectYears: true,
            selectMonths: true,
            min: [1990, 01, 01],
            max: [2016, 12, 31]
        });
        chartProfile();
    });
    
    $('#p-pt').on('click', '#addExamen', function(e) {
       e.preventDefault();
       if($("#listeExamen :selected").text() === "Selectionner un examen" || $('#dosage').val() === "" || $("#dateExam").val() === ""){
            $("#alertExamen").show();
       }else{
            $("#alertExamen").hide();
            $.ajax({
                 url: '<?php echo $this->Html->url(array('controller' => 'examens', 'action' => 'add', 'home' => true), true); ?>',
                 type: 'POST',
                 data: {
                     "Examen": {
                         "nom": $("#listeExamen :selected").text(),
                         "dosage": $('#dosage').val(),
                         "date": $("#dateExam").val(),
                         "patient_id" : $("#PatientId").val()
                     }
                 },
                 success: function (response) {
                     if (response) {
                     }
                 }
             });
        }
        chartProfile();
    });
});
<?php echo $this->Html->scriptEnd(); ?>