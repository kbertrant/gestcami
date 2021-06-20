var id = null;
var bool = false;
var oldnomSite = null;
var datecreation = null;
window.ID = null;

function init(){
    $('#nom').val('');
    $('#region').val('');
    $('#pfacture').val('');
    $('#ptransport').val('');
    $('#nom').focus();
    window.ID = null;
    $('#buttonS').text('Enregistrer');
    bool = false;
    id = null;
}

$('#formSite').submit(function(e){
    e.preventDefault();
})

function save(){
    var nomSite = $('#nom').val();
    var regioSite = $('#region').val();
    var prixFacture = $('#pfacture').val();
    var prixTransport = $('#ptransport').val();
    

    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/siteView.php',
            data: {
                'action': 'update',
                'id': id,
                'nom': nomSite,
                'oldnom': oldnomSite,
                'region': regioSite,
                'pfacture': prixFacture,
                'ptransport': prixTransport,
                'datecreation': datecreation

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
    $.ajax({
        type: 'POST',
        url: 'api/view/siteView.php',
        data: {
            'action': 'insert',
            'nom': nomSite,
            'region': regioSite,
            'pfacture': prixFacture,
            'ptransport': prixTransport
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
}

function update(i){
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#nom').val(man.results[0].NOM_SITE);
            $('#region').val(man.results[0].REGION_SITE);
            $('#pfacture').val(man.results[0].PRIX_FACTURE);
            $('#ptransport').val(man.results[0].PRIX_TRANSPORT);
              
            oldnomSite = man.results[0].NOM_SITE;
            datecreation = man.results[0].DATE_CREAT_SITE;
               
            id = i;
            $('#buttonS').text('Modifier');
            bool = true;
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function selected(id){
    window.ID = id;
    $('.modal-body').text('Voulez vous vraiment supprimer ce site ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=suppr&id='+window.ID,
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

function getAll(){
    var tr = '';
    $.ajax({
        type: 'GET',
        url: 'api/view/siteView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                tr += "<tr><td>"+man.results[i].NOM_SITE+"</td><td>"+man.results[i].REGION_SITE+"</td><td width='10%'>"+man.results[i].PRIX_FACTURE+"</td><td width='13%'>"+man.results[i].PRIX_TRANSPORT+"</td><td width='14%'>"+man.results[i].DATE_CREAT_SITE+"</td><td width='14%'>"+man.results[i].DATE_MODIF_SITE+"</td><td><button onclick='update("+man.results[i].ID_SITE+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                    "<button onclick='selected("+man.results[i].ID_SITE+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
            }
            $('#listSite').html(tr);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();