var Id = null;
var bool = false;
var oldnom = null;
var datecreate = null;
var dossier = null;
window.ID = null;
window.NOM = null;
var tmp = '';

function init(){
    $('#nom').val('');
    $('#contact').val('');
    $('#fiscale').val('');
    $('#nameinterne').val('');
    $('#orange').val('');
    $('#mtn').val('');
    $('#nextell').val('');
    $('#nom').focus();
    $('#buttonS').text('Enregistrer');
    bool = false;
    id = null;
    dossier = null;
    window.ID = null;
}

var data = null;
var up = {
    chemin: '',
    tmp: ''
};

function image_shower(un){
    $('#image_fisc').html("<img src='"+un+"' alt='' style='width: 100%;height: auto;'/>");
}

function load(){
    data = new FormData();
    $.each($('#fiscale')[0].files, function (i, file) {
        data.append('file-'+i, file);
    });
    data.append('nom', $('#nom').val());
    data.append('length', $('#fiscale')[0].files.length);
    //Get count of selected files
    var countFiles = $('#fiscale')[0].files.length;

    var imgPath = $('#fiscale')[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#files");
    image_holder.empty();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image",
                        'data-toggle':'modal',
                        'data-target':'.image_shower',
                        'onclick': image_shower(e.target.result)
                    }).appendTo(image_holder);
                }

                image_holder.show();
                reader.readAsDataURL($('#fiscale')[0].files[i]);
            }
            $.ajax({
                url: 'api/view/loadFile.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(rslt){
                    up = rslt;
                    console.log(up);
                    showAlert(rslt);
                },
                error: function () {
                    console.log('merde...');
                }
            });
        } else {
            showAlert({status: 'error', message: "This browser does not support FileReader."});
        }
    } else {
        showAlert({status: 'error', message:"Pls select only images"});
    }
}

function upload(){
    $.ajax({
        url: 'api/view/upload.php',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(rslt){
            showAlert(rslt);
        },
        error: function () {
            console.log('merde...');
        }
    });
}

$('#formTransport').submit(function(e){
    e.preventDefault();
})

function save(){
    var nom = $('#nom').val();
    var contact= $('#contact').val();
    var name= $('#nameinterne').val();
    var Orange = $('#orange').val()+ "/" +$('#mtn').val()+ "/" +$('#nextell').val();
    var chemin = '';
    var tmp = '';
    for(var t = 0; t < up.length; t++){
        chemin += up[t].chemin + '--';
        tmp += up[t].tmp + '--';
    }
    if(bool){
        $.ajax({
            type: 'POST',
            url: 'api/view/transporteurView.php',
            data: {
                'action': 'update',
                'id': Id,
                'nom': nom,
                'contact': contact,
                'fiscale': chemin,
                'oldnom': oldnom,
                'nameinterne': name,
                'orange': Orange,
                'Datecreation': datecreate,
                'tmp': tmp
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
        url: 'api/view/transporteurView.php',
        data: {
            'action': 'insert',
            'nom': nom,
            'contact': contact,
            'fiscale': chemin,
            'nameinterne': name,
            'orange': Orange,
            'tmp': tmp
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
        url: 'api/view/transporteurView.php?action=getById&id='+i,
        success: function(data){
            var man = eval('('+ data +')');
            $('#nom').val(man.results[0].NOM_TRANSPORTEUR);
            $('#contact').val(man.results[0].CONTACT);
            $('#nameinterne').val(man.results[0].NAME_INTERNE);
            $('#datemodification').val(man.results[0].DATE_MODIF_TRANSPORT);
            $('#datecreate').val(man.results[0].DATE_CREAT_TRANSPORT);
            var num = man.results[0].NUMERO_INTERNE.split('/');
            $('#orange').val(num[0]);
            $('#mtn').val(num[1]);
            $('#nextell').val(num[2]);
            var tab = man.results[0].listImage;
            var tmps = man.results[0].tmps;

            var image_holder = $("#files");
            image_holder.empty();
            bool = true;
            var img = '';

            if(tab != null){
                for(var j = 0; j < tab.length; j++){
                    //img += "<img src='"+tab[j]+"' class='thumb-image' data-toggle='modal' data-target='.image_shower' onclick='image_shower('"+tab[j]+"')'/>";
                    //$('#files').html(img);
                    var op = {
                        "src": tab[j],
                        "class": "thumb-image",
                        'data-toggle':'modal',
                        'data-target':'.image_shower',
                        'onclick': 'image_shower("'+tab[j]+'")'
                    };
                    console.log(op);
                    $("<img />", op).appendTo(image_holder);
                }
            }

            oldnom = man.results[0].NOM_TRANSPORTEUR;
            contact= man.results[0].CONTACT;
            nameinterne= man.results[0].NAME_INTERNE;
            datecreate = man.results[0].DATE_CREAT_TRANSPORT;
            Id = i;
            $('#buttonS').text('Modifier');
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function selected(id, nom){
    window.ID = id;
    window.NOM = nom;
    $('.modal-body').text('Voulez vous vraiment supprimer ce transporteur ?');
}

function suppr(){
    $.ajax({
        type: 'GET',
        url: 'api/view/transporteurView.php?action=suppr&Id='+window.ID+'&nom="'+window.NOM+'"',
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
    $.ajax({
        type: 'GET',
        url: 'api/view/transporteurView.php?action=getAll',
        success: function(data){
            var man = eval('('+ data +')');
            var image_holder = $("#imgA");
            var img = '';
            if(man.results != null){
                for(var k = 0; k < man.results.length; k++){
                    for(var j = 0; j < man.results[k].fiscs.length; j++){
                        img += '<img src="'+man.results[k].fiscs[j]+'" width="50" height="50"/>';
                    }
                    man.results[k].IMG = img;
                    img = '';
                }
                console.log(man.results);
                for(var i = 0; i < man.results.length; i++){
                    var tab = man.results[i].listImage;
                    tr += "<tr><td>"+man.results[i].NOM_TRANSPORTEUR+"</td>" +
                        "<td width='8%'>"+man.results[i].CONTACT+"</td>" +
                        "<td id='imgA'>"+man.results[i].IMG+"</td>" +
                        "<td>"+man.results[i].NAME_INTERNE+"</td>" +
                        "<td>"+man.results[i].NUMERO_INTERNE+"</td>" +
                        "<td width='10%'>"+man.results[i].DATE_CREAT_TRANSPORT+"</td>" +
                        "<td width='10%'>"+man.results[i].DATE_MODIF_TRANSPORT+"</td>" +
                        "<td><button onclick='update("+man.results[i].ID_TRANSPORTEUR+")' id='set' class='btn btn-default'><i class='fa fa-pencil'></i></button>  "+
                        "<button onclick='selected("+man.results[i].ID_TRANSPORTEUR+", '"+man.results[i].NOM_TRANSPORTEUR+"')' data-toggle='modal' data-target='.bs-example-modal-sm' class='btn btn-danger'><i class='fa fa-close'></button></td></tr>"
                    if(tab != null){
                        for(var j = 0; j < tab.length; j++){
                            $("<img />", {
                                "src": tab[j],
                                'data-toggle':'modal',
                                'data-target':'.image_shower',
                                'onclick': image_shower(tab[j])
                            }).appendTo(image_holder);
                        }
                    }
                }
                $('#listTransporteur').html(tr);
            }

        },
        error: function () {
            console.log('merde...');
        }
    });
}

getAll();
