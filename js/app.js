if(window.location.hash == '' || window.location.hash == '#/home' || window.location.hash == '#'){
  window.location.hash = '#/home';
}

var page = '';
var log = {
    pseudo: '',
    password: '',
    action: 'auth'
};

function logout(){
    $.ajax({
        type: 'POST',
        url: 'api/view/userView.php',
        data: {
            action: 'logout'
        },
        datatype: 'json',
        success: function(data){
            var rep = eval('(' + data + ')');
            if(rep.status == 'success'){
                currentUser = {};
                $('.ydct_login').fadeIn('slow', function () {
                    showAlert(rep);
                });
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

function verifySession(){
    $.ajax({
        type: 'POST',
        url: 'api/view/userView.php',
        data: {
            action: 'session'
        },
        datatype: 'json',
        success: function(data){
            var rep = eval('(' + data + ')');
            var currentUser = rep;
            if(rep.status == 'success'){
                $('.ydct_login').css('display', 'none');
                $('.username').text(currentUser.nom + ' ' + currentUser.prenom);
            }else {
                $('.ydct_login').fadeIn('slow');
            }
        },
        error: function () {
            console.log('merde...');
        }
    });
}

verifySession();

function initPage(view) {
  $.ajax({
      type: 'POST',
      url: view,
      success: function(data){
          $('#content').html(data);
      },
      error: function () {
          console.log('merde...');
      }
  });
}

function verifPseudo(){
    var val = $('#pseudo').val();
    if(val != ''){
        if(/^[a-z0-9]+$/.test(val)){
            $('#pseudo').css('border-color', 'green');
        }else {
            $('#pseudo').css('border-color', 'red');
        }
    }else {
        $('#pseudo').css('border-color', 'red');
    }

}

function verifChamp(p){
    var val = $('#'+p).val();
    if(val != ''){
        $('#'+p).css('border-color', 'green');
    }else {
        $('#'+p).css('border-color', 'red');
    }
}

$('#formLogin').submit(function (e) {
    e.preventDefault();
    var currentUser = {
        uid: '',
        nom: '',
        prenom: '',
        pseudo: '',
    }
    log.pseudo = $('#pseudo').val();
    log.password = $('#password').val();
    if(log.pseudo != '' && log.password != ''){
        if(/^[a-z0-9]+$/.test(log.pseudo) != false){
            $.ajax({
                type: 'POST',
                url: 'api/view/userView.php',
                data: log,
                datatype: 'json',
                success: function(data){
                    var rep = eval('(' + data + ')');
                    currentUser.uid = rep.uid;
                    currentUser.prenom = rep.prenom;
                    currentUser.pseudo = rep.pseudo;
                    currentUser.nom = rep.nom;
                    if(rep.status == 'success' && currentUser.uid != ''){
                        $('#pseudo').val('');
                        $('#password').val('');
                        $('.ydct_login').fadeOut('slow', function () {
                            showAlert(rep);
                            $('.username').text(currentUser.nom + ' ' + currentUser.prenom);
                        });
                    }else {
                        showAlert(rep);
                    }
                },
                error: function () {
                    console.log('merde...');
                }
            });
        }else {
            showAlert({status : 'error', message: 'Le pseudo ne doit pas contenir de caractère spéciaux.'});
        }
    }else {
        showAlert({status : 'error', message: 'Veillez remplir tous les champs SVP.'});
    }

})

function showAlert(obj){
    $('#alert_message').text(obj.message);
    if(obj.status == 'success'){
        $('.ydct_alert').css('background-color', '#009688');
    }else {
        $('.ydct_alert').css('background-color', '#cb2a2a');
    }
    $('.ydct_alert').fadeIn('slow', function () {
        setTimeout(function () {
            $('.ydct_alert').fadeOut('slow');
        }, 2000);
    })
}

if(window.location.hash == '#/home'){
  page = 'views/home.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/camion'){
  page = 'views/GCamion.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/chauffeur'){
  page = 'views/GChauffeur.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/produit'){
  page = 'views/GProduit.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/site'){
  page = 'views/GSite.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/transporteur'){
  page = 'views/GTransporteur.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/voyage'){
  page = 'views/GVoyage.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/user'){
  page = 'views/GUser.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/follow'){
  page = 'views/follow.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/facturation'){
  page = 'views/fac-money.html';
  initPage(page);
verifySession();
}else if(window.location.hash == '#/client'){
  page = 'views/GClient.html';
  initPage(page);
verifySession();
}
