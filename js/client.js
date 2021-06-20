var id = null;
var bool = false;
var name = null;
var Datecreate = null;
window.ID = null;

function init(){
    $('#nom').val('');
    $('#nom').focus();
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

$('#formClient').submit(function(e){
    e.preventDefault();
})

function save(){
    var Nom = $('#nom').val();

    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/clientView.php',
            data: {
                'action': 'update',
                'id': id,
                'nom': Nom,
                'oldnom':name,
                'datecreate': Datecreate
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
        url: 'api/view/clientView.php',
        data: {
            'action': 'insert',
            'nom': Nom
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
        url: 'api/view/clientView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#nom').val(man.results[0].NOM);

            name = man.results[0].NOM;
            Datecreate = man.results[0].DATE_CREAT_CLIENT;

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
    $('.modal-body').text('Voulez vous vraiment supprimer ce client ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/clientView.php?action=suppr&id='+window.ID,
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

function getRecherche(){
    var tr = '';
    $.ajax
    ({
        type: 'POST',
        url: 'api/view/clientView.php',
        data:{
            action:'search',
            Nom:$("#recherche").val()
        },
        success: function(data)
        {
            var man = eval('('+ data +')');
            if(man.status == 'success'){
                for(var i = 0; i < man.results.length; i++)
                {
                    tr += "<tr><td>"+man.results[i].NOM_CLIENT+"</td><td>"+man.results[i].DATE_CREAT_CLI+"</td><td>"+man.results[i].DATE_MODIF_CLI+"</td><td><button onclick='update("+man.results[i].ID_CLIENT+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                    "<button onclick='selected("+man.results[i].ID_CLIENT+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
                }
                $('#listClient').html(tr);
            }else {
                $('#listClient').html(tr);
            }

        },
        error: function () {
            console.log('merde...');
        }
    });
}


function getAll(){
    var tr = '';
    $.ajax
    ({
        type: 'GET',
        url: 'api/view/clientView.php?action=getAll',
        success: function(data)
        {
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++)
            {
                tr += "<tr><td>"+man.results[i].NOM+"</td><td>"+man.results[i].DATE_CREAT_CLIENT+"</td><td>"+man.results[i].DATE_MODIF_CLIENT+"</td><td><button onclick='update("+man.results[i].ID_CLIENT+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                    "<button onclick='selected("+man.results[i].ID_CLIENT+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
            }
            $('#listClient').html(tr);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();
