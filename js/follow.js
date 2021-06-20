/**
 * Created by admin on 19/09/2016.
 */
var id = null;
var bool = false;
var date_creation = null;
var old_id_chauf = null;
window.ID = null;
var elt = null;

function init(){
    $('#y_site_depart').val('0');
    $('#y_chauffeur').val('0');
    $('#y_produit').val('0');
    $('#y_client').val('0');
    $('#diff').val('0');
    $('#y_site_arrive').val('0');
    $('#num_recu').val('');
    $('#tonnage_depart').val('');
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

init();

function initialize(){
    init();
    search();
}

$('#formVoyage').submit(function (e) {
    e.preventDefault();
    var id_site = $('#y_site_depart').val();
    var id_chauf = $('#y_chauffeur').val();
    var id_prod = $('#y_produit').val();
    var sit_id_site = $('#y_site_arrive').val();
    var ton_depart = $('#tonnage_depart').val();
    var nombre_sac = $('#nbresac').val();
    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/voyageView.php',
            data: {
                'action': 'update_min',
                'id': id,
                'id_site': id_site,
                'id_chauf': id_chauf,
                'old_id_chauf': old_id_chauf,
                'id_prod': id_prod,
                'sit_id_site': sit_id_site,
                'ton_depart': ton_depart,
                'nombre_sac': nombre_sac,
                'date_creation': date_creation
            },
            success: function(data){
                var man = eval('('+ data +')');
                showAlert(man);
                if(man.status == 'success'){
                    getAll();
                    init();
                }
            },
            error: function () {
                console.log('merde...');
            }
        });
        return 0;
    }
});

function update(i){
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#y_site_depart').val(man.results[0].ID_SITE);
            $('#y_chauffeur').val(man.results[0].ID_CHAUFFEUR);
            $('#y_produit').val(man.results[0].ID_PRODUIT);
            $('#y_site_arrive').val(man.results[0].SIT_ID_SITE);
            $('#tonnage_depart').val(man.results[0].TONNAGE_DEPART);
            $('#nbresac').val(man.results[0].NOMBRE_SAC);
            id = i;

            date_creation = man.results[0].DATE_CREATION;
            old_id_chauf = man.results[0].ID_CHAUFFEUR;
            $('#buttonS').text('Modifier');
            bool = true;
        },
        error: function () {
            console.log('some thing wrong...');
        }
    });
}

function take(obj){
    console.log(obj);
}

function setHeader(on){
    if(on == '#final'){
        $('#v_tonnage_depart').val(elt.TONNAGE_DEPART);
        $('#v_tonnage_arrive').val(elt.TONNAGE_ARRIVE);
        $('#v_nbre_sac').val(elt.NOMBRE_SAC);
        $('#v_num_be').val(elt.NUM_BE);
        $('#v_tonnage_trans').val(elt.TONNAGE_TRANS);
    }else if(on == '#avance'){
        $('#avancePaiement').val(elt.AVANCE_PAIEMENT);
    }else if(on == '#accident'){
        $('#v_incident').val(elt.INCIDENT_SURVENU);
    }else if(on == '#permut'){
        $('#v_camion').val(elt.PERMUTATION);
        $('#v_description').val(elt.DESCRIPTION_VOYAGE);
    }else if(on == '#autre'){
        $('#v_autre').val(elt.AUTRE_DEPENSE);
    }
    $(on).html("<div class='col-md-6'>" +
        "<b>Immatriculation</b>: "+elt.MATRICULE+"</div> <div class='col-md-6'>" +
        "<b>Chauffeur</b>: "+elt.NOM_CHAUFFEUR+"</div><div class='col-md-6'>" +
        "<b>Site départ</b>: "+elt.NOM_SITE_DEPART+"</div> <div class='col-md-6'>" +
        "<b>Site d\'arrivée</b>: "+elt.NOM_SITE_ARRIVE+"</div> <div class='col-md-6'>" +
        "<b>Produit</b>: "+elt.NOM_PRODUIT+"</div> <div class='col-md-6'>" +
        "<b>Date de création</b>: "+elt.DATE_CREATION+"</div>");
}

function setContent(){
    $('#details').html("<div class='col-md-6'>" +
        "<b>Immatriculation</b>: "+elt.MATRICULE+"</div> <div class='col-md-6'>" +
        "<b>Chauffeur</b>: "+elt.NOM_CHAUFFEUR+"</div><div class='col-md-6'>" +
        "<b>Site départ</b>: "+elt.NOM_SITE_DEPART+"</div> <div class='col-md-6'>" +
        "<b>Site d\'arrivée</b>: "+elt.NOM_SITE_ARRIVE+"</div> <div class='col-md-6'>" +
        "<b>Produit</b>: "+elt.NOM_PRODUIT+"</div> <div class='col-md-6'>" +
        "<b>Date de création</b>: "+elt.DATE_CREATION+"</div><div class='col-md-6'>" +
        "<b>Client</b>: "+elt.NOM+"</div><div class='col-md-6'>" +
        "<b>Avance paiement: </b>: "+elt.AVANCE_PAIEMENT+"</div><div class='col-md-6'>" +
        "<b>Permuation: </b>: "+permut()+"</div><div class='col-md-6'>" +
        "<b>Transporteur: </b>: "+elt.NOM_TRANSPORTEUR+"</div><div class='col-md-6'>" +
        "<b>Nombre de sac</b>: "+elt.NOMBRE_SAC+"</div><div class='col-md-6'>" +
        "<b>Tonnage départ</b>: "+elt.TONNAGE_DEPART+"</div><div class='col-md-6'>" +
        "<b>Tonnage arrivé</b>: "+elt.TONNAGE_ARRIVE+"</div><div class='col-md-6'>" +
        "<b>autre dépense</b>: "+elt.AUTRE_DEPENSE+"</div><div class='col-md-12 alert alert-danger'>" +
        "<b>Incident survenu: </b>: "+inc()+"</div><div class='col-md-12 alert alert-danger'>" +
        "<b>Raison de la permutation: </b>: "+desc()+"</div><div class='col-md-12 alert alert-info'>" +
        "<b>Différence de poids</b>: <h2>"+elt.DIFFERENCE_POIDS+"</h2></div>");
}

function inc(){
    return elt.INCIDENT_SURVENU == '' || elt.INCIDENT_SURVENU == null ? 'RAS' : elt.INCIDENT_SURVENU;
}

function desc(){
    return elt.DESCRIPTION_VOYAGE == '' || elt.DESCRIPTION_VOYAGE == null ? 'RAS' : elt.DESCRIPTION_VOYAGE;
}

function permut(){
    return elt.PERMUT == '' || elt.PERMUT == null ? 'RAS' : elt.PERMUT;
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=suppr&id='+window.ID,
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function viewButton(){
    if(elt == null){
        $('#btnPermut').attr('disabled', 'true');
        $('#btnAvance').attr('disabled', 'true');
        $('#btnAccident').attr('disabled', 'true');
        $('#btnFinal').attr('disabled', 'true');
        $('#btnAutre').attr('disabled', 'true');
        $('#infos_primo').fadeIn('slow');
    }else {
        $('#btnPermut').removeAttr('disabled');
        $('#btnAvance').removeAttr('disabled');
        $('#btnAccident').removeAttr('disabled');
        $('#btnFinal').removeAttr('disabled');
        $('#btnAutre').removeAttr('disabled');
        $('#infos_primo').fadeOut('slow');
    }
}

function getSites(){
    var option = $('#y_site_depart').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_SITE+"'>"+man.results[i].NOM_SITE+"</option>";
            }
            $('#y_site_depart').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getSitesA(){
    var option = $('#y_site_arrive').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_SITE+"'>"+man.results[i].NOM_SITE+"</option>";
            }
            $('#y_site_arrive').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getChauffeur(){
    var option = $('#y_chauffeur').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/chauffeurView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_CHAUFFEUR+"'>"+man.results[i].NOM_CHAUFFEUR+"</option>";
            }
            $('#y_chauffeur').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getProduit(){
    var option = $('#y_produit').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/produitView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_PRODUIT+"'>"+man.results[i].NOM_PRODUIT+"</option>";
            }
            $('#y_produit').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getClient(){
    var option = $('#y_client').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/clientView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_CLIENT+"'>"+man.results[i].NOM+"</option>";
            }
            $('#y_client').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

var hu = null;
function select(i, a){
    if(hu != null){
        $(hu).removeClass('actif');
    }
    hu = a;
    $(a).addClass('actif');
    console.log(i);
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            if(man.status == 'success'){
                elt = man.results[0];
                viewButton();
                setContent();
            }
        },
        error: function () {
            console.log('some thing wrong...');
        }
    });
}

function search(){
    var option = {
        action: 'search',
        chauffeur: $('#y_chauffeur').val() == '0' ? '' : $('#y_chauffeur').val(),
        produit: $('#y_produit').val() == '0' ? '' : $('#y_produit').val(),
        site_arrivee: $('#y_site_arrive').val() == '0' ? '' : $('#y_site_arrive').val(),
        site_depart: $('#y_site_depart').val() == '0' ? '' : $('#y_site_depart').val(),
        diff: $('#diff').val(),
        num_recu: $('#num_recu').val(),
        date_creation: $('#date_creation').val(),
        client: $('#y_client').val() == '0' ? '' : $('#y_client').val(),
        statut: 0,
        annulation: 0,
        final: 0
    };
    console.log(option);
    var tr = '';
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: option,
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
              man.results.forEach(t => {
                t.ARRONDI = Math.round(t.TONNAGE_ARRIVE);
                t.TOTAL = t.ARRONDI * (t.PRIX_TD * 1000);
              })
                for(var i = 0; i < man.results.length; i++){
                    var a = 'elmt'+man.results[i].ID_VOYAGE;
                    tr += "<tr class='tabl' id='"+a+"' onclick='select("+man.results[i].ID_VOYAGE+", "+a+")'>" +
                        "<td>"+man.results[i].NUM_RECU+"</td>" +
                        "<td width='9%'>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td width='9%'>"+man.results[i].NOM_SITE_DEPART+"</td>" +
                        "<td width='9%'>"+man.results[i].MATRICULE+"</td>" +
                        "<td>"+man.results[i].NOMBRE_SAC+"</td>" +
                        "<td width='5%'>"+man.results[i].TONNAGE_DEPART+"</td>" +
                        "<td width='5%'>"+man.results[i].TONNAGE_ARRIVE+"</td>" +
                        "<td width='5%'>"+man.results[i].ARRONDI+"</td>" +
                        "<td>"+man.results[i].PRIX_TD * 1000+"</td>" +
                        "<td>"+man.results[i].REVENU_TOTAL+"</td>" +
                        "<td><button id='set' data-toggle='modal' data-target='.terminate' class='btn btn-success'><i class='ion-checkmark-round'></i></button>  "+
                        "<button data-toggle='modal' data-target='.annulation' class='btn btn-danger'><i class='fa fa-close'></i></button>" +
                        "&nbsp<button data-toggle='modal' data-target='#details_voyage' class='btn btn-default'><i class='fa fa-eye'></i></button></td></tr>"
                }
                $('#listVoyage').html(tr);
            }else {
                $('#listVoyage').html(tr);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getAll(){
    var tr = '';
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=getActif',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                man.results.forEach(t => {
                  t.ARRONDI = Math.round(t.TONNAGE_ARRIVE);
                  t.TOTAL = t.ARRONDI * (t.PRIX_TD * 1000);
                })
                for(var i = 0; i < man.results.length; i++){
                    var a = 'elmt'+man.results[i].ID_VOYAGE;
                    tr += "<tr class='tabl' id='"+a+"' onclick='select("+man.results[i].ID_VOYAGE+", "+a+")'>" +
                        "<td>"+man.results[i].NUM_RECU+"</td>" +
                        "<td width='9%'>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td width='9%'>"+man.results[i].NOM_SITE_DEPART+"</td>" +
                        "<td width='9%'>"+man.results[i].MATRICULE+"</td>" +
                        "<td>"+man.results[i].NOMBRE_SAC+"</td>" +
                        "<td width='5%'>"+man.results[i].TONNAGE_DEPART+"</td>" +
                        "<td width='5%'>"+man.results[i].TONNAGE_ARRIVE+"</td>" +
                        "<td width='5%'>"+man.results[i].ARRONDI+"</td>" +
                        "<td>"+man.results[i].PRIX_TD * 1000+"</td>" +
                        "<td>"+man.results[i].FACTURATION_TRANSPORTEUR+"</td>" +
                        "<td><button id='set' data-toggle='modal' data-target='.terminate' class='btn btn-success'><i class='ion-checkmark-round'></i></button>  "+
                        "<button data-toggle='modal' data-target='.annulation' class='btn btn-danger'><i class='fa fa-close'></i></button>" +
                        "&nbsp<button data-toggle='modal' data-target='#details_voyage' class='btn btn-default'><i class='fa fa-eye'></i></button></td></tr>"
                }
                $('#listVoyage').html(tr);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function finalize(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'terminate',
            'id': elt.ID_VOYAGE,
            'ton_depart': $('#v_tonnage_depart').val(),
            'ton_arrive': $('#v_tonnage_arrive').val(),
            'nombre_sac': $('#v_nbre_sac').val(),
            'dif_poids': parseFloat($('#v_tonnage_arrive').val()) - parseFloat($('#v_tonnage_depart').val()),
            'facturation_trans': Math.round(parseInt($('#v_tonnage_trans').val())) * (elt.PRIX_TD * 1000),
            'depense_jubenros': Math.round(parseFloat($('#v_tonnage_arrive').val())) * (elt.PRIX_FD * 1000),
            'facturation_chauffeur': Math.round(parseInt($('#v_tonnage_arrive').val()) - parseInt($('#v_tonnage_trans').val())) * (elt.PRIX_TD * 1000),
            'tonnage_trans': $('#v_tonnage_trans').val(),
            'num_be': $('#v_num_be').val(),
            'final': true
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                select(elt.ID_VOYAGE, hu);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function saveIncident(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'incident',
            'id': elt.ID_VOYAGE,
            'incident': $('#v_incident').val()
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                select(elt.ID_VOYAGE, hu);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function saveAutre(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'autre_depense',
            'id': elt.ID_VOYAGE,
            'autre': $('#v_autre').val()
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                select(elt.ID_VOYAGE, hu);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function saveAvance(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'avance',
            'id': elt.ID_VOYAGE,
            'avance': $('#avancePaiement').val()
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                select(elt.ID_VOYAGE, hu);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function savePermut(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'permut',
            'id': elt.ID_VOYAGE,
            'permutation': $('#v_camion').val(),
            'desc_voyage': $('#v_description').val()
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                select(elt.ID_VOYAGE, hu);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function annulation(){
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'annulation',
            'id': elt.ID_VOYAGE,
            'annulation': true
        },
        success: function(data){
            var man = eval('('+ data +')');
            showAlert(man);
            if(man.status == 'success'){
                getAll();
                init();
                elt = null;
                viewButton();
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}
function final(){
    if(elt.FINAL > 0){
        $.ajax({
            type: 'POST',
            url: 'api/view/voyageView.php',
            data: {
                'action': 'final',
                'id': elt.ID_VOYAGE,
                'status_voyage': true
            },
            success: function(data){
                var man = eval('('+ data +')');
                showAlert(man);
                if(man.status == 'success'){
                    getAll();
                    init();
                    elt = null;
                    viewButton();
                }
            },
            error: function () {
                console.log('merde...');
            }
        });
    }else {
        showAlert({status: 'error', message: 'Ce voyage n\'est pas complet'});
    }

}

function getCamions(){
    var option = $('#v_camion').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/camionView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results.length > 0){
                for(var i = 0; i < man.results.length; i++){
                    option += "<option value='"+man.results[i].ID_CAMION+"'>"+man.results[i].MATRICULE+"</option>";
                }
                $('#v_camion').html(option);
            }else {
                $('#v_camion').html('<option value="0"></option>');
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();
getChauffeur();
getCamions();
getProduit();
getSites();
getClient();
getSitesA();
viewButton();
