var id = null;
var bool = false;
var oldmatricule = null;
var datecreation = null;
window.ID = null;

function init(){
    $('#matricule').val('');
    $('#tonnage').val('');
    $('#couleur').val('');
    $('#marque').val('');
    $('#photo').val('');
    $('#ydct_transporteur').val('0');
    $('#matricule').focus();
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}


$('#formCamion').submit(function(e){
    e.preventDefault();
});

function save(){
    var matricule = $('#matricule').val();
    var tonnage = $('#tonnage').val();
    var couleur = $('#couleur').val();
    var marque = $('#marque').val();
    var photo = $('#photo').val();
    var id_trans = $('#ydct_transporteur').val();;

    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/camionView.php',
            data: {
                'action': 'update',
                'id': id,
                'matricule': matricule,
                'oldMatricule': oldmatricule,
                'tonnage': tonnage,
                'couleur': couleur,
                'marque': marque,
                'photo': photo,
                'datecreation': datecreation,
                'id_trans': id_trans
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
        url: 'api/view/camionView.php',
        data: {
            'action': 'insert',
            'matricule': matricule,
            'tonnage': tonnage,
            'couleur': couleur,
            'marque': marque,
            'photo': photo,
            'id_trans': id_trans
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
        url: 'api/view/camionView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#matricule').val(man.results[0].MATRICULE);
            $('#tonnage').val(man.results[0].TONNAGE);
            $('#couleur').val(man.results[0].COULEUR);
            $('#marque').val(man.results[0].MARQUE);
            $('#photo').val(man.results[0].PHOTO);
            $('#ydct_transporteur').val(man.results[0].ID_TRANSPORTEUR);
            $('#datecreation').val(man.results[0].DATE_CREAT_CAM);
            
            oldmatricule = man.results[0].MATRICULE;
            datecreation = man.results[0].DATE_CREAT_CAM;
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
    $('.modal-body').text('Voulez vous vraiment supprimer ce camion ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/camionView.php?action=suppr&id='+window.ID,
        success: function(data){
            var man = eval('(' + data + ')');
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

function getTransporteurs(){
    var option = $('#ydct_transporteur').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/transporteurView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    option += "<option value='"+man.results[i].ID_TRANSPORTEUR+"'>"+man.results[i].NOM_TRANSPORTEUR+"</option>";
                }
                $('#ydct_transporteur').html(option);
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
        url: 'api/view/camionView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    tr += "<tr>" +
                        "<td>"+man.results[i].MATRICULE+"</td>" +
                        "<td>"+man.results[i].NOM_TRANSPORTEUR+"</td>" +
                        "<td>"+man.results[i].TONNAGE+"</td>" +
                        "<td style='background-color: "+man.results[i].COULEUR+"'></td>" +
                        "<td>"+man.results[i].MARQUE+"</td>" +
                        "<td>"+man.results[i].PHOTO+"</td>" +
                        "<td>"+man.results[i].DATE_CREAT_CAM+"</td>" +
                        "<td>"+man.results[i].DATE_MODIF_CAM+"</td>" +
                        "<td><button onclick='update("+man.results[i].ID_CAMION+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                        "<button onclick='selected("+man.results[i].ID_CAMION+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
                }
                $('#listCamion').html(tr);
            }
            
        },
        error: function () {
            console.log('merde...');
        }
    });
}
getAll();
getTransporteurs();