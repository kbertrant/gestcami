var id = null;
var bool = false;
var oldpseudo = null;
var datecreation = null;
window.ID = null;

function init(){
    $('#nom').val('');
    $('#prenom').val('');
    $('#pseudo_us').val('');
    $('#password_us').val('');
    $('#conpassword').val('');
    $('#poste').val('');
    $('#nom').focus();
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

init();

$('#formUser').submit(function (e) {
    e.preventDefault();
    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var pseudo = $('#pseudo_us').val();
    var password = $('#password_us').val();
    var poste = $('#poste').val();
    if(nom != '' && prenom != '' && pseudo != '' && password != '' && poste != ''){
        var a = $('#password_us').val();
        var b = $('#conpassword').val();
        if(a == b){
            if(bool){
                $.ajax({
                    type: 'POST',
                    url: 'api/view/userView.php',
                    data: {
                        'action': 'update',
                        'id': id,
                        'nom': nom,
                        'prenom': prenom,
                        'pseudo': pseudo,
                        'oldpseudo': pseudo,
                        'password': password,
                        'poste': poste,
                        'date_create': datecreation,
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
                url: 'api/view/userView.php',
                data: {
                    'action': 'insert',
                    'nom': nom,
                    'prenom': prenom,
                    'pseudo': pseudo,
                    'password': password,
                    'poste': poste
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
        else {
            showAlert({status: 'error', message : 'Mot de passe différent'});
        }
    }else{
        showAlert({status: 'error', message : 'Veillez remplir les champs'});
    }

});

function update(i){
    $.ajax({
        type: 'GET',
        url: 'api/view/userView.php?action=getOne&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#nom').val(man.results[0].NOM_USER);
            $('#prenom').val(man.results[0].PRENOM_USER);
            $('#pseudo_us').val(man.results[0].PSEUDO_USER);
            $('#password_us').val(man.results[0].PASSWORD_USER);
            $('#conpassword').val(man.results[0].PASSWORD_USER);
            $('#poste').val(man.results[0].POSTE);

            oldpseudo = man.results[0].PSEUDO_USER;
            datecreation = man.results[0].DATE_CREAT_USER;
               
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
    $('.modal-body').text('Voulez vous vraiment supprimer cette utilisateur ?');
}

function suppr(id){
    $.ajax({
        type: 'GET',
        url: 'api/view/userView.php?action=suppr&id='+window.ID,
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
        url: 'api/view/userView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++){
                tr += "<tr><td>"+man.results[i].NOM_USER+"</td><td>"+man.results[i].PRENOM_USER+"</td><td>"+man.results[i].PSEUDO_USER+"</td><td>"+man.results[i].POSTE+"</td><td>"+man.results[i].DATE_CREAT_USER+"</td><td>"+man.results[i].DATE_MODIF_USER+"</td><td><button onclick='update("+man.results[i].ID_USER+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                    "<button onclick='selected("+man.results[i].ID_USER+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
            }
            $('#listUser').html(tr);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();