var requete = null;
function creerRequete() {
    try {
        /* On tente de créer un objet XmlHTTPRequest */
        requete = new XMLHttpRequest();
    } catch (microsoft) {
        /* Microsoft utilisant une autre technique, on essays de créer un objet ActiveX */
        try {
            requete = new ActiveXObject('Msxml2.XMLHTTP');
        } catch (autremicrosoft) {
            /* La première méthode a échoué, on en teste une seconde */
            try {
                requete = new ActiveXObject('Microsoft.XMLHTTP');
            } catch (echec) {
                /* À ce stade, aucune méthode ne fonctionne... mettez donc votre navigateur à jour ;) */
                requete = null;
            }
        }
    }
    if (requete === null) {
        alert('Impossible de créer l\'objet requête,\nVotre navigateur ne semble pas supporter les object XMLHttpRequest.');
    }
}
var host = document.location.hostname;
function actualiser_action() {
    var response = requete.responseText;
    var blocListe = document.getElementById('p-pt');
    blocListe.innerHTML = response;
}
function actualiser_detail_consult() {
    var response = requete.responseText;
    var blocListe = document.getElementById('detail_ajax');
    blocListe.innerHTML = response;
}
function actualiser_modif_patient() {
    var response = requete.responseText;
    var blocListe = document.getElementById('modifPt_ajax');
    blocListe.innerHTML = response;
}
function patientFolder(p) {
    document.getElementById('p-pt').innerHTML = null;
    //var blocListe = document.getElementById('p-pt');
    //blocListe.innerHTML = "Chargement ...";
    creerRequete();
    //var url = host + '/users/';
    var url = '/DCI/patients/patient_folder/' + p;
    requete.open('GET', url, true);
    requete.onreadystatechange = function () {
        if (requete.readyState === 4) {
            if (requete.status === 200) {
                actualiser_action();
            }
        }
    };
    requete.send(null);
}
function detailAction(p, clazz) {
    document.getElementById('detail_ajax').innerHTML = null;
    creerRequete();
    //var url = host + '/users/';
    var url = '/DCI/' + clazz + '/detail_consultation/' + p;
    requete.open('GET', url, true);
    requete.onreadystatechange = function () {
        if (requete.readyState === 4) {
            if (requete.status === 200) {
                actualiser_detail_consult();
            }
        }
    };
    requete.send(null);
}
function modifPtAction(p, clazz) {
    document.getElementById('modifPt_ajax').innerHTML = null;
    creerRequete();
    var url = '/DCI/home/' + clazz + '/detail_patient/' + p;
    requete.open('GET', url, true);
    requete.onreadystatechange = function () {
        if (requete.readyState === 4) {
            if (requete.status === 200) {
                actualiser_modif_patient();
            }
        }
    };
    requete.send(null);
}