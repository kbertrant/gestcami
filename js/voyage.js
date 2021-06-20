/**
 * Created by admin on 19/09/2016.
 */
var id = null;
var bool = false;
var date_creation = null;
window.ID = null;
var elt = null;

function init(){
    $('#y_site_depart').val('0');
    $('#y_chauffeur').val('0');
    $('#y_produit').val('0');
    $('#y_client').val('0');
    $('#y_site_arrive').val('0');
    $('#tonnage_depart').val('');
    $('#nbresac').val('');
    $('#num_recu').val('');
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

init();

$('#formVoyage').submit(function (e) {
    e.preventDefault();
    var id_site = $('#y_site_depart').val();
    var id_chauf = $('#y_chauffeur').val();
    var id_prod = $('#y_produit').val();
    var id_client = $('#y_client').val();
    var sit_id_site = $('#y_site_arrive').val();
    var ton_depart = $('#tonnage_depart').val();
    var num_recu = $('#num_recu').val();
    var option = {
        'action': 'update_min',
        'id': id,
        'id_site': id_site,
        'id_chauf': id_chauf,
        'oldnum_recu': elt.NUM_RECU,
        'id_prod': id_prod,
        'num_recu': num_recu,
        'id_client': id_client,
        'sit_id_site': sit_id_site,
        'ton_depart': ton_depart,
        'date_creation': date_creation
    };
    console.log(option);
    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/voyageView.php',
            data: option,
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
    $.ajax({
        type: 'POST',
        url: 'api/view/voyageView.php',
        data: {
            'action': 'insert',
            'id_site': id_site,
            'id_chauf': id_chauf,
            'num_recu': num_recu,
            'id_prod': id_prod,
            'id_client': id_client,
            'sit_id_site': sit_id_site,
            'ton_depart': ton_depart
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
});

function update(i){
    $.ajax({
        type: 'GET',
        url: 'api/view/voyageView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            elt = man.results[0];
            $('#y_site_depart').val(man.results[0].ID_SITE);
            $('#y_chauffeur').val(man.results[0].ID_CHAUFFEUR);
            $('#y_produit').val(man.results[0].ID_PRODUIT);
            $('#y_client').val(man.results[0].ID_CLIENT);
            $('#y_site_arrive').val(man.results[0].SIT_ID_SITE);
            $('#tonnage_depart').val(man.results[0].TONNAGE_DEPART);
            $('#num_recu').val(man.results[0].NUM_RECU);
            id = i;

            date_creation = man.results[0].DATE_CREATION;
            $('#buttonS').text('Modifier');
            bool = true;
            $('#num_recu').focus();
        },
        error: function () {
            console.log('some thing wrong...');
        }
    });
}

function selected(id){
    window.ID = id;
    $('.modal-body').text('Voulez vous vraiment supprimer ce voyage ?');
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

function getSites(){
    var option = $('#yb_site_depart').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_SITE+"'>"+man.results[i].NOM_SITE+"</option>";
            }
            $('#yb_site_depart').html(option);
            $('#y_site_depart').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getSitesA(){
    var option = $('#yb_site_arrive').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_SITE+"'>"+man.results[i].NOM_SITE+"</option>";
            }
            $('#yb_site_arrive').html(option);
            $('#y_site_arrive').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getChauffeur(){
    var option = $('#yb_chauffeur').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/chauffeurView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_CHAUFFEUR+"'>"+man.results[i].NOM_CHAUFFEUR+"</option>";
            }
            $('#yb_chauffeur').html(option);
            $('#y_chauffeur').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getProduit(){
    var option = $('#yb_produit').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/produitView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_PRODUIT+"'>"+man.results[i].NOM_PRODUIT+"</option>";
            }
            $('#yb_produit').html(option);
            $('#y_produit').html(option);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function getClient(){
    var option = $('#yb_client').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/clientView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                option += "<option value='"+man.results[i].ID_CLIENT+"'>"+man.results[i].NOM+"</option>";
            }
            $('#yb_client').html(option);
            $('#y_client').html(option);
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
        url: 'api/view/voyageView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    tr += "<tr>" +
                        "<td width='9%'>"+man.results[i].NUM_RECU+"</td>" +
                        "<td width='9%'>"+man.results[i].TONNAGE_DEPART+"</td>" +
                        "<td width='9%'>"+man.results[i].NOM+"</td>" +
                        "<td>"+man.results[i].NOM_PRODUIT+"</td><td>"+man.results[i].NOM_SITE_DEPART+"</td><td>"+man.results[i].NOM_SITE_ARRIVE+"</td>" +
                        "<td>"+man.results[i].NOM_CHAUFFEUR+"</td>" +
                        "<td>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td><button onclick='update("+man.results[i].ID_VOYAGE+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                        "<button onclick='selected("+man.results[i].ID_VOYAGE+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
                }
                $('#listVoyage').html(tr);
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function search(){
    var option = {
        action: 'search',
        chauffeur: $('#yb_chauffeur').val() == '0' ? '' : $('#yb_chauffeur').val(),
        produit: $('#yb_produit').val() == '0' ? '' : $('#yb_produit').val(),
        site_arrivee: $('#yb_site_arrive').val() == '0' ? '' : $('#yb_site_arrive').val(),
        site_depart: $('#yb_site_depart').val() == '0' ? '' : $('#yb_site_depart').val(),
        diff: $('#diff').val(),
        num_recu: $('#b_num_recu').val(),
        date_creation: $('#date_creation').val(),
        client: $('#yb_client').val() == '0' ? '' : $('#yb_client').val(),
        statut: $('#statut:checked').val() == 'on' ? true : false,
        final: 0,
        annulation: $('#annulation:checked').val() == 'on' ? true : false
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
                for(var i = 0; i < man.results.length; i++){
                    tr += "<tr>" +
                        "<td width='9%'>"+man.results[i].NUM_RECU+"</td>" +
                        "<td width='9%'>"+man.results[i].TONNAGE_DEPART+"</td>" +
                        "<td width='9%'>"+man.results[i].NOM+"</td>" +
                        "<td>"+man.results[i].NOM_PRODUIT+"</td>" +
                        "<td>"+man.results[i].NOM_SITE_DEPART+"</td>" +
                        "<td>"+man.results[i].NOM_SITE_ARRIVE+"</td>" +
                        "<td>"+man.results[i].NOM_CHAUFFEUR+"</td>" +
                        "<td>"+man.results[i].DATE_CREATION+"</td>" +
                        "<td><button onclick='update("+man.results[i].ID_VOYAGE+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                        "<button onclick='selected("+man.results[i].ID_VOYAGE+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
                }
                $('#listVoyage').html(tr);
            }else {
                $('#listVoyage').html('');
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();
getChauffeur();
getProduit();
getClient();
getSites();
getSitesA();
