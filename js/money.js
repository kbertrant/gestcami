
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

function viewButton(){
    if(elt == null){
        //$('#btnPermut').attr('disabled', 'true');
        $('#infos_primo').fadeIn('slow');
    }else {
        //$('#btnPermut').removeAttr('disabled');
        $('#infos_primo').fadeOut('slow');
    }
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
        statut: 1,
        annulation: 0,
        final: 1
    };
    console.log(option);
    var tr = '';
    var table = '<table class="table table-small-font table-bordered table-striped"><tbody>';
    var th = '';
    var TOTAL = 0;
    var arron = 0;
    var table2 = '<table class="table table-small-font table-bordered table-striped"><tbody>';
    var th2 = '';
    var tonT = 0;
    var frais = 0;
    var chauf = 0;
    var cout = 0;
    var avan = 0;
    var autres = 0;
    var netTotal = 0;
    var totaux = 0;
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: option,
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    man.results[i].ARRONDI = Math.round(man.results[i].TONNAGE_ARRIVE);
                    man.results[i].TOTAL = man.results[i].ARRONDI * (man.results[i].PRIX_TD * 1000);
                    var a = 'elmt'+man.results[i].ID_VOYAGE;
                    var net = (parseFloat(man.results[i].TONNAGE_TRANS) * (man.results[i].PRIX_TD * 1000))-man.results[i].FRAIS_DEMARCHEUR-man.results[i].AVANCE_PAIEMENT-man.results[i].AUTRE_DEPENSE;
                    tr += "<tr class='tabl' id='"+a+"' onclick='select("+man.results[i].ID_VOYAGE+", "+a+")'>" +
                        "<td>"+man.results[i].NUM_RECU+"</td>" +
                        "<td>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td>"+man.results[i].NOM_SITE_DEPART+"</td>" +
                        "<td>"+man.results[i].MATRICULE+"</td>" +
                        "<td>"+man.results[i].ARRONDI+"</td>" +
                        "<td>"+numeral(man.results[i].ARRONDI * (man.results[i].PRIX_FD * 1000)).format('0,0')+"</td>" +
                        "<td>"+man.results[i].NOM_TRANSPORTEUR+"</td>" +
                        "<td>"+man.results[i].NOM+"</td>" +
                        "<td>"+numeral(man.results[i].PRIX_TD * 1000).format('0,0')+"</td>" +
                        "<td style='color:green;'>"+numeral((man.results[i].ARRONDI - Math.round(man.results[i].TONNAGE_TRANS)) * (man.results[i].PRIX_TD * 1000)).format('0,0')+"</td>" +
                        "<td style='color:blue;'>"+numeral(man.results[i].TONNAGE_TRANS * (man.results[i].PRIX_TD * 1000)).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].FRAIS_DEMARCHEUR).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].AVANCE_PAIEMENT).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].AUTRE_DEPENSE).format('0,0')+"</td>" +
                        "<td style='color:red;'>"+numeral(net).format('0,0')+"</td>" +
                        "<td><button data-toggle='modal' data-target='#details_voyage' class='btn btn-default'><i class='fa fa-eye'></i></button></td></tr>";

                    TOTAL += man.results[i].ARRONDI * (man.results[i].PRIX_FD * 1000);
                    arron += parseFloat(man.results[i].ARRONDI);
                    frais += parseFloat(man.results[i].FRAIS_DEMARCHEUR);
                    tonT += Math.round(man.results[i].TONNAGE_TRANS);
                    chauf += parseFloat(man.results[i].TONNAGE_TRANS) * (man.results[i].PRIX_TD * 1000);
                    avan += parseFloat(man.results[i].AVANCE_PAIEMENT);
                    autres += parseFloat(man.results[i].AUTRE_DEPENSE);
                    cout += (parseFloat(man.results[i].ARRONDI) - Math.round(man.results[i].TONNAGE_TRANS)) * (man.results[i].PRIX_TD * 1000);
                    netTotal += net;
                }
                totaux += net + autres + chauf + avan;
                $('#listVoyage').html(tr);
                th += "<tr><th>TOTAL</th><td style='text-align: right;color:green'>"+numeral(TOTAL).format('0,0')+"</td></tr>";
                th += "<tr><th>TOTAL T.Arrivé</th><td style='text-align: right;'>"+arron+"</td></tr>";
                table += th + "</body></table>";
                th2 += "<tr><th>TOTAL DEPENSES</th><td colspan=7 style='text-align: right;color:blueviolet'>"+numeral(totaux).format('0,0')+"</td></tr>";
                th2 += "<tr>" +
                    "<th colspan='2'>Total T.Transp</th>" +
                    "<th>T. Chauffeur</th>" +
                    "<th>T. Cout Transp</th>" +
                    "<th>T. Frais Démarcheur</th>" +
                    "<th>T. Avances</th>" +
                    "<th>T. Autres dépenses</th>" +
                    "<th>T. Net</th>" +
                    "</tr>";
                th2 += "<tr>" +
                    "<td colspan='2'>"+tonT+"</td>" +
                    "<td>"+numeral(chauf).format('0,0')+"</td>" +
                    "<td>"+numeral(cout).format('0,0')+"</td>" +
                    "<td>"+numeral(frais).format('0,0')+"</td>" +
                    "<td>"+numeral(avan).format('0,0')+"</td>" +
                    "<td>"+numeral(autres).format('0,0')+"</td>" +
                    "<td style='text-align: right;color:red'>"+numeral(netTotal).format('0,0')+"</td>" +
                    "</tr>";
                table2 += th2 + "</tbody></table>"
                $('#globalInfos2').html(table);
                $('#globalInfos3').html(table2);
                getGlobal(option);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getGlobal(option){
    var table = '<table class="table table-small-font table-bordered table-striped"><tbody>';
    var tr = '';
    var th = '';
    var TOTAL = 0;
    var AVAN = 0;
    var AUTRE = 0;
    option.action = 'groupBy';
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: option,
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    TOTAL += parseFloat(man.results[i].SUMDJ);
                    th += "<tr><th>"+man.results[i].NOM_TRANSPORTEUR+"</th><td style='text-align: right;'>"+numeral(parseFloat(man.results[i].SUMDJ)).format('0,0')+"</td></tr>";
                    AVAN += parseFloat(man.results[i].SUMAP);
                    AUTRE += parseFloat(man.results[i].SUMAD);
                }
                th += "<tr><th>TOTAL</th><td style='text-align: right;color:violet'>"+numeral(TOTAL).format('0,0')+"</td></tr>";
                th += "<tr><th>AVANCE</th><td style='text-align: right;'>"+numeral(AVAN).format('0,0')+"</td></tr>";
                th += "<tr><th>SOLDE</th><td style='text-align: right;'>"+numeral(AUTRE).format('0,0')+"</td></tr>";
                table += th + "</tbody></table>";
                $('#globalInfos').html(table);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getAll(){
    var table = '<table class="table table-small-font table-bordered table-striped"><tbody>';
    var th = '';
    var TOTAL = 0;
    var arron = 0;
    var tr = '';
    var table2 = '<table class="table table-small-font table-bordered table-striped"><tbody>';
    var th2 = '';
    var tonT = 0;
    var frais = 0;
    var chauf = 0;
    var cout = 0;
    var avan = 0;
    var autres = 0;
    var netTotal = 0;
    var totaux = 0;
    var option = {
        action: 'groupBy',
        chauffeur: $('#y_chauffeur').val() == '0' ? '' : $('#y_chauffeur').val(),
        produit: $('#y_produit').val() == '0' ? '' : $('#y_produit').val(),
        site_arrivee: $('#y_site_arrive').val() == '0' ? '' : $('#y_site_arrive').val(),
        site_depart: $('#y_site_depart').val() == '0' ? '' : $('#y_site_depart').val(),
        diff: $('#diff').val(),
        num_recu: $('#num_recu').val(),
        date_creation: $('#date_creation').val(),
        client: $('#y_client').val() == '0' ? '' : $('#y_client').val()
    };
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=getAllFinish',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    man.results[i].ARRONDI = Math.round(man.results[i].TONNAGE_ARRIVE);
                    man.results[i].TOTAL = man.results[i].ARRONDI * (man.results[i].PRIX_TD * 1000);
                    var a = 'elmt'+man.results[i].ID_VOYAGE;
                    var net = (parseFloat(man.results[i].TONNAGE_TRANS) * (man.results[i].PRIX_TD * 1000))-man.results[i].FRAIS_DEMARCHEUR-man.results[i].AVANCE_PAIEMENT-man.results[i].AUTRE_DEPENSE;
                    tr += "<tr class='tabl' id='"+a+"' onclick='select("+man.results[i].ID_VOYAGE+", "+a+")'>" +
                        "<td>"+man.results[i].NUM_RECU+"</td>" +
                        "<td>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td>"+man.results[i].NOM_SITE_DEPART+"</td>" +
                        "<td>"+man.results[i].MATRICULE+"</td>" +
                        "<td>"+man.results[i].ARRONDI+"</td>" +
                        "<td>"+numeral(man.results[i].ARRONDI * (man.results[i].PRIX_FD * 1000)).format('0,0')+"</td>" +
                        "<td>"+man.results[i].NOM_TRANSPORTEUR+"</td>" +
                        "<td>"+man.results[i].NOM+"</td>" +
                        "<td>"+numeral(man.results[i].PRIX_TD * 1000).format('0,0')+"</td>" +
                        "<td style='color:green;'>"+numeral((man.results[i].ARRONDI - Math.round(man.results[i].TONNAGE_TRANS)) * (man.results[i].PRIX_TD * 1000)).format('0,0')+"</td>" +
                        "<td style='color:blue;'>"+numeral(man.results[i].TONNAGE_TRANS * (man.results[i].PRIX_TD * 1000)).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].FRAIS_DEMARCHEUR).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].AVANCE_PAIEMENT).format('0,0')+"</td>" +
                        "<td>"+numeral(man.results[i].AUTRE_DEPENSE).format('0,0')+"</td>" +
                        "<td style='color:red;'>"+numeral(net).format('0,0')+"</td>" +
                        "<td><button data-toggle='modal' data-target='#details_voyage' class='btn btn-default'><i class='fa fa-eye'></i></button></td></tr>";

                    TOTAL += man.results[i].ARRONDI * (man.results[i].PRIX_FD * 1000);
                    arron += parseFloat(man.results[i].ARRONDI);
                    frais += parseFloat(man.results[i].FRAIS_DEMARCHEUR);
                    tonT += Math.round(man.results[i].TONNAGE_TRANS);
                    chauf += parseFloat(man.results[i].TONNAGE_TRANS) * (man.results[i].PRIX_TD * 1000);
                    avan += parseFloat(man.results[i].AVANCE_PAIEMENT);
                    autres += parseFloat(man.results[i].AUTRE_DEPENSE);
                    cout += (parseFloat(man.results[i].ARRONDI) - Math.round(man.results[i].TONNAGE_TRANS)) * (man.results[i].PRIX_TD * 1000);
                    netTotal += net;
                }
                totaux += net + autres + chauf + avan;
                $('#listVoyage').html(tr);
                th += "<tr><th>TOTAL</th><td style='text-align: right;color:green'>"+numeral(TOTAL).format('0,0')+"</td></tr>";
                th += "<tr><th>TOTAL T.Arrivé</th><td style='text-align: right;'>"+arron+"</td></tr>";
                table += th + "</body></table>";
                th2 += "<tr><th>TOTAL DEPENSES</th><td colspan=7 style='text-align: right;color:blueviolet';>"+numeral(totaux).format('0,0')+"</td></tr>";
                th2 += "<tr>" +
                        "<th colspan='2'>Total T.Transp</th>" +
                        "<th>T. Chauffeur</th>" +
                        "<th>T. Cout Transp</th>" +
                        "<th>T. Frais Démarcheur</th>" +
                        "<th>T. Avances</th>" +
                        "<th>T. Autres dépenses</th>" +
                        "<th>T. Net</th>" +
                    "</tr>";
                th2 += "<tr>" +
                    "<td colspan='2'>"+tonT+"</td>" +
                    "<td>"+numeral(chauf).format('0,0')+"</td>" +
                    "<td>"+numeral(cout).format('0,0')+"</td>" +
                    "<td>"+numeral(frais).format('0,0')+"</td>" +
                    "<td>"+numeral(avan).format('0,0')+"</td>" +
                    "<td>"+numeral(autres).format('0,0')+"</td>" +
                    "<td style='text-align: right;color:red'>"+numeral(netTotal).format('0,0')+"</td>" +
                    "</tr>";
                table2 += th2 + "</tbody></table>"
                $('#globalInfos2').html(table);
                $('#globalInfos3').html(table2);
                getGlobal(option);
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
