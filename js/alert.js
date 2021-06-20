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