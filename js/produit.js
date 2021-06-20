var id = null;
var bool = false;
var name = null;
var Datecreate = null;
window.ID = null;

function init(){
    $('#nom').val('');
    $('#description').val('');
    $('#nom').focus();
    $('#buttonS').text('Enregistrer');
    bool = false;
    window.ID = null;
    id = null;
}

$('#formProduit').submit(function(e){
    e.preventDefault();
})

function save(){
    var Nom = $('#nom').val();
    var Description = $('#description').val();
   
    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/produitView.php',
            data: {
                'action': 'update',
                'id': id,
                'nom': Nom,
                'oldnom':name,
                'description': Description,
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
        url: 'api/view/produitView.php',
        data: {
            'action': 'insert',
            'nom': Nom,
            'description': Description
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
        url: 'api/view/produitView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#nom').val(man.results[0].NOM_PRODUIT);
            $('#description').val(man.results[0].DESCRIPTION);
            $('#DateModification').val(man.results[0].DATE_MODIF_PRO);
            $('#dateCreateateCreate').val(man.results[0].DATE_CREAT_PRO);

            name = man.results[0].NOM_PRODUIT;
            Datecreate = man.results[0].DATE_CREAT_PRO;

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
    $('.modal-body').text('Voulez vous vraiment supprimer ce produit ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/produitView.php?action=suppr&id='+window.ID,
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

function getAll(){
    var tr = '';
    $.ajax
    ({
        type: 'GET',
        url: 'api/view/produitView.php?action=getAll',
        success: function(data)
        {
            var man = eval('('+ data +')');
            for(var i = 0; i < man.results.length; i++)
            {
                tr += "<tr><td>"+man.results[i].NOM_PRODUIT+"</td><td>"+man.results[i].DESCRIPTION+"</td><td>"+man.results[i].DATE_MODIF_PRO+"</td><td>"+man.results[i].DATE_CREAT_PRO+"</td><td><button onclick='update("+man.results[i].ID_PRODUIT+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                    "<button onclick='selected("+man.results[i].ID_PRODUIT+")' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></i></button></td></tr>"
            }
            $('#listProduit').html(tr);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();