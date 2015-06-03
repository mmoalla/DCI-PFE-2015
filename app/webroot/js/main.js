jQuery().ready(function () {
    /******************* Ajout User *******************/
    $("#choiceTit").on('click', "#titulaireC", function () {
        var choix = $(this).val();
        $("#titulaire").val(choix);
    });
    /******************* TOOTLTIP *******************/
    $("#tootltip").tooltip();
    /******************* ALERT *******************/
    $(".dci-alert").addClass('animated zoomInUp').fadeIn();
    $(".dci-alert").delay(5000).fadeOut();
    /******************* PLANNING *******************/
    $(".dci-month").hide();
    $(".dci-month:first").show();
    $(".dci-months a:first").addClass("active");
    var current = 1;
    $(".dci-months a").click(function () {
        var month = $(this).attr("id").replace("linkMonth", "");
        if (month !== current) {
            $('.events-title').hide();
            $('.dci-table td .events').removeClass('events-list');
            $('#month' + current).slideUp();
            $('#month' + month).slideDown();
            $('.dci-months a').removeClass('active');
            $('.dci-months > ul > li > a#linkMonth' + month).addClass('active');
            current = month;
        }
        return false;
    });
    $('.dci-table td').click(function () {
        $(this).toggleClass('tdactive');
        $('.dci-table td .events').toggleClass('events-list');
    });
    /******************* FORM WIZARD ADD PATIENT *******************/
    $(document).on('change', '#typepaiement', function () {
        if ($("#typepaiement").find(':selected').text() === "Carte bancaire") {
            $('.carte-banque').show();
            $('.cheque').hide();
        } else if ($("#typepaiement").find(':selected').text() === "Espèce") {
            $('.carte-banque').hide();
            $('.cheque').hide();
        } else if ($("#typepaiement").find(':selected').text() === "Chèque") {
            $('.carte-banque').hide();
            $('.cheque').show();
        } else if ($("#typepaiement").find(':selected').text() === "Choisissez le type de paiement") {
            $('.carte-banque').hide();
            $('.cheque').hide();
        }
    });
    $("#motif").on("keyup", function () {
        var motif = $("#motif").val();
        $("#designation").val(motif);
    });
    $("#motif").on("change", function () {
        var designation = $("#designation").val();
        if (designation !== "") {
            $("#desgcof").html(designation);
        } else {
            $("#desgcof").html("");
        }
    });
    $('#rootwizard').bootstrapWizard({
        onNext: function (tab, navigation, index) {
            if (index === 1) {
                if (!$('#nom').val()) {
                    $("#alert").html('Sasisser le nom du patient').show();
                    $('#nom').focus();
                    return false;
                } else if (!$('#prenom').val()) {
                    $("#alert").html('Sasisser le prénom du patient').show();
                    $('#prenom').focus();
                    return false;
                } else if (!$('#birthdate').val()) {
                    $("#alert").html('Choisisser la date de naissance du patient').show();
                    $('#birthdate').focus();
                    return false;
                } else if (!$('#sexe').val()) {
                    $("#alert").html('Choisisser le sexe du patient').show();
                    $('#sexe').focus();
                    return false;
                } else if (!$('#nationalite').val()) {
                    $("#alert").html('Choisisser la nationnalité du patient').show();
                    $('#nationalite').focus();
                    return false;
                } else if (!$('#job').val()) {
                    $("#alert").html('Sasisser le travail du patient').show();
                    $('#job').focus();
                    return false;
                } else if (!$('#adresse').val()) {
                    $("#alert").html('Sasisser l\'adresse du patient').show();
                    $('#adresse').focus();
                    return false;
                } else if (!$('#ville').val()) {
                    $("#alert").html('Sasisser la ville du patient').show();
                    $('#ville').focus();
                    return false;
                } else if (!$('#tel').val()) {
                    $("#alert").html('Sasisser le téléphone du patient').show();
                    $('#tel').focus();
                    return false;
                } else if (!$('#email').val()) {
                    $("#alert").html('Sasisser l\'email du patient').show();
                    $('#email').focus();
                    return false;
                } else if (!$('#age').val()) {
                    $("#alert").html('Sasisser l\'age du patient').show();
                    $('#age').focus();
                    return false;
                } else if (!$('#taille').val()) {
                    $("#alert").html('Sasisser la taille du patient').show();
                    $('#taille').focus();
                    return false;
                } else if (!$('#poids').val()) {
                    $("#alert").html('Sasisser le poids du patient').show();
                    $('#poids').focus();
                    return false;
                } else if (!$('#blood').val()) {
                    $("#alert").html('Choisisser le groupe sanguin du patient').show();
                    $('#blood').focus();
                    return false;
                } else if (!$('#numss').val()) {
                    $("#alert").html('Sasisser le n° de sécurité social du patient').show();
                    $('#numss').focus();
                    return false;
                } else {
                    $("#alert").hide();
                }
            } else if (index === 2) {
                if (!$('#motif').val()) {
                    $("#alert").html('Sasisser le motif de consultation').show();
                    $('#motif').focus();
                    return false;
                } else if (!$('#datedebut').val()) {
                    $("#alert").html('Sasisser la date d\'entrée').show();
                    $('#datedebut').focus();
                    return false;
                } else if (!$('#datefin').val()) {
                    $("#alert").html('Sasisser la date de sortie').show();
                    $('#datefin').focus();
                    return false;
                } else if (!$('#heure').val()) {
                    $("#alert").html('Sasisser l\'heure de la consultation').show();
                    $('#heure').focus();
                    return false;
                } else if (!$('#user_id').text()) {
                    $("#alert").html('Sasisser le docteur').show();
                    $('#user_id').focus();
                    return false;
                } else if (!$('#chambre_id').text()) {
                    $("#alert").html('Sasisser la chambre').show();
                    $('#chambre_id').focus();
                    return false;
                } else {
                    $("#alert").hide();
                }
            } else if (index === 3) {
                if (!$('#designation').val()) {
                    $("#alert").html('Sasisser la désignation').show();
                    $('#designation').focus();
                    return false;
                } else if (!$('#montant').val()) {
                    $("#alert").html('Sasisser le montant de la consultation').show();
                    $('#montant').focus();
                    return false;
                } else if (!$('#devise').val()) {
                    $("#alert").html('Choisissez la devise').show();
                    $('#devise').focus();
                    return false;
                } else if (!$('#acompte').val()) {
                    $("#alert").html("Sasisser l'acompte").show();
                    $('#acompte').focus();
                    return false;
                } else if ($('#typepaiement :selected').text() === 'Carte bancaire') {
                    if (!$('#numcarte').val() || !$('#expiration').val() || !$('#cryptogramme').val()) {
                        $("#alert").html('Sasisser le n° de carte bancaire, la date d\'expiration et le n° du cryptogramme social du patient').show();
                        $('#numcarte').focus();
                        $('#expiration').focus();
                        $('#cryptogramme').focus();
                        return false;
                    }
                } else if ($('#typepaiement :selected').text() === 'Chèque') {
                    if (!$('#numcheque').val()) {
                        $("#alert").html('Sasisser le n° du chèque du patient').show();
                        $('#numcheque').focus();
                        return false;
                    }
                } else {
                    $("#alert").hide();
                }
            }
        },
        onTabShow: function (tab, navigation, index) {
            // Dynamically change percentage completion on progress bar
            var tabCount = navigation.find('li').length;
            var current = index + 1;
            var percentDone = (current / tabCount) * 100;
            $('#rootwizard').find('#progressBar').css({width: percentDone + '%'});
            // Optional: Show Done button when on last tab; 
            // It is invisible by default.
            $('#rootwizard').find('.last').toggle(current >= tabCount);
            // Optional: Hide Next button if on last tab; 
            // otherwise it shows but is disabled
            $('#rootwizard').find('.next').toggle(current < tabCount);
        }
    });
    /******************* DATE PICKER (PIKADTE) *******************/
    $('.datepicker').pickadate({
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
        min: new Date('yyy-mm-dd'),
        max: [2016, 12, 31]
    });
    $('.datepickerexp').pickadate({
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
        min: [2015, 12, 31],
        max: [2018, 12, 31]
    });
    $('.dp-birthdate').pickadate({
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
        min: [1900, 01, 01],
        max: [2013, 12, 31]
    });
    $('.timepicker').pickatime({
        format: 'HH:i',
        formatSubmit: 'HH:i',
        interval: 5,
        min: [07, 00],
        max: [00, 00]
    });
    /******************* SEARCH PATIENT *******************/
    $("#search").keyup(function () {
        var search = $(this).val();
        $.getJSON("http://localhost/DCI/pages/search_patient/" + search + ".json", function (data) {
            var items = [];
            $.each(data, function (key, val) {
                items.push("<ul class='dci-search'><li data-value='" + val.Patient._id + "'><a href='#' id='showP'><img src='/DCI/img/avatars/" + val.Patient.avatar + "' /><span>" + val.Patient.prenom + " " + val.Patient.nom + "</span></a></li></ul>");
                if (!$.isEmptyObject(val) && search !== "") {
                    $("#ressearch").html(items).show();
                } else if ($.isEmptyObject(val)) {
                    console.log("b");
                    $("#ressearch").html("<ul class='dci-search'><li>Aucun patient ne correspond à votre recherche</li></ul>").show();
                    //$("#ressearch").hide();
                }
            });
        });
    });
//remplir les champs du formulaire d'admission automatiquement
    $('#ressearch').on('click', '#showP', function (e) {
        $('#ressearch').hide();
        e.preventDefault();
        var id = $(this).parent().attr('data-value');
        $.getJSON("http://localhost/DCI/pages/search_f_patient/" + id + ".json", function (data) {
            $('#search').val('');
            $('#ressearch').hide();
            $("#idPatient").attr('readonly', 'readonly').val(data.Patient._id);
            $("#nom").attr('readonly', 'readonly').val(data.Patient.nom);
            $("#prenom").attr('readonly', 'readonly').val(data.Patient.prenom);
            $("#birthdate").attr('disabled', 'disabled').val(data.Patient.birthdate);
            $("#sexe").attr('readonly', 'readonly').val(data.Patient.sexe);
            $("#nationalite").attr('readonly', 'readonly').val(data.Patient.nationalite);
            $("#job").attr('readonly', 'readonly').val(data.Patient.job);
            $("#adresse").attr('readonly', 'readonly').val(data.Patient.adresse);
            $("#ville").attr('readonly', 'readonly').val(data.Patient.ville);
            $("#tel").attr('readonly', 'readonly').val(data.Patient.tel);
            $("#email").attr('readonly', 'readonly').val(data.Patient.email);
            $("#age").attr('readonly', 'readonly').val(data.Patient.age);
            $('#avatar-addon').remove();
            $("#pt-avatar").append("<img style='max-width: 100%;height: 225px;display: block;border-radius: 3px;' class='thumbnail' src='/DCI/img/avatars/" + data.Patient.avatar + "' />");
            $("#avatar").attr('readonly', 'readonly').hide();
            $("#dci-form-column").css('top', '-218px').css('margin-bottom', '-240px');
            $("#taille").attr('readonly', 'readonly').val(data.Patient.taille);
            $("#poids").attr('readonly', 'readonly').val(data.Patient.poids);
            $("#blood").attr('readonly', 'readonly').val(data.Patient.blood);
            $("#numss").attr('readonly', 'readonly').val(data.Patient.numss);
            if ($("#nom").val() !== "" && $("#prenom").val() !== "" && $("#adresse").val() !== "" && $("#tel").val() !== "") {
                $("#no").html($("#nom").val());
                $("#pr").html($("#prenom").val());
                $("#adr").html($("#adresse").val());
                $("#phone").html($("#tel").val());
            }
        });
    });
    /******************* Folder Patient *******************/
    $("#ressearch").on('click', '#showP', function () {
        var idPatient = $(this).parent('li').attr('data-value');
        $.get("http://localhost/DCI/patients/patient_folder/" + idPatient, function (response) {
            $("#p-pt").html(response);
        });
    });
    /******************* TABS *******************/
    $('#myTab a').click(function () {
        $(this).tab('show');
    });
    /******************* CALCUL AGE *******************/
    $("#birthdate").change(function () {
        var birthdate = $("#birthdate").val();
        var year = birthdate.substr(0, 4); //afficher l'annee de birthdate
        var thisYear = new Date().getFullYear(); //afficher l'annee courante
        var age = thisYear - year; // afficher l'age exacte
        if (thisYear === year) {
            $("#age").val("0");
        } else if (year < thisYear) {
            $("#age").val(age);
        }
    });

    /******************* RECLAMATION DROPDOWN *******************/
    $(".dropdown-claim").hide();
    $(".dropdown-claim").parent().css('border-bottom', 'none');
    $("#reclam").click(function () {
        if ($(".dropdown-claim").is(':hidden')) {
            $("#reclam .caret").css('transform', 'rotate(180deg)').css('-webkit-transform', 'rotate(180deg)').css('-ms-transform', 'rotate(180deg)');
            $(".dropdown-claim").slideDown();
        } else {
            $("#reclam .caret").css('transform', 'rotate(0)').css('-webkit-transform', 'rotate(0)').css('-ms-transform', 'rotate(0)');
            $(".dropdown-claim").slideUp();
        }
    });
});