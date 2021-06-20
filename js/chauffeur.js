var id = null;
var bool = false;
var name = null;
var datecreation = null;
window.ID = null;

function init(){
    $('#ydct_camion').val('0');
    $('#nom').val('');
    $('#cni').val('');
    $('#contact').val('');
    document.getElementById('statut_chauff').checked = false;
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

init();

$('#formChauffeur').submit(function(e){
    e.preventDefault();
})

function save(){
    var camion= $('#ydct_camion').val();
    var nom= $('#nom').val();
    var numerocni = $('#cni').val();
    var contact = $('#contact').val();
    var statut = $('#statut_chauff:checked').val() == 'on' ? 1 : 0;

    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/chauffeurView.php',
            data: {
                'action': 'update',
                'id': id,
                'camion': camion,
                'nom': nom,
                'cni': numerocni,
                'oldnom': name,
                'statut': statut,
                'contact': contact,
                'datecreate': datecreation

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
        url: 'api/view/chauffeurView.php',
        data: {
            'action': 'insert',
            'cni': numerocni,
            'camion': camion,
            'nom': nom,
            'contact': contact,
            'statut': statut
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
        url: 'api/view/chauffeurView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#ydct_camion').val(man.results[0].ID_CAMION);
            $('#nom').val(man.results[0].NOM_CHAUFFEUR);
            $('#cni').val(man.results[0].NUMEROCNI);
            document.getElementById('statut_chauff').checked = man.results[0].STATUS_CHAUFFEUR == 0 ? false : true;
            $('#contact').val(man.results[0].CONTACT);

            name = man.results[0].NOM_CHAUFFEUR;
            datecreation = man.results[0].DATE_CREAT_CHAUF;

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
    $('.modal-body').text('Voulez vous vraiment supprimer ce chauffeur ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/chauffeurView.php?action=suppr&id='+window.ID,
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

function getCamions(){
    var option = $('#ydct_camion').html();
    $.ajax({
        type: 'GET',
        url: 'api/view/camionView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results.length > 0){
                for(var i = 0; i < man.results.length; i++){
                    option += "<option value='"+man.results[i].ID_CAMION+"'>"+man.results[i].MATRICULE+"</option>";
                }
                $('#ydct_camion').html(option);
            }else {
                $('#ydct_camion').html('<option value="0"></option>');
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
        url: 'api/view/chauffeurView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            if(man.results != null){
                for(var i = 0; i < man.results.length; i++){
                    tr += "<tr><td>"+man.results[i].MATRICULE+"</td><td>"+man.results[i].NOM_CHAUFFEUR+"</td><td>"+man.results[i].TONNAGE+"</td><td>"+man.results[i].NUMEROCNI+"</td><td>"+(man.results[i].STATUS_CHAUFFEUR == 0 ? 'libre' : 'occupé')+"</td><td>"+man.results[i].CONTACT+"</td><td><button onclick='update("+man.results[i].ID_CHAUFFEUR+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                        "<button onclick='selected("+man.results[i].ID_CHAUFFEUR+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
                }
                $('#listChauffeur').html(tr);
            }

        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();
getCamions();
