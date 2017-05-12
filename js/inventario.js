/**
 * Created by brlaranjeira on 5/12/17.
 */

function showAlert(type,title,msg) {
    if (type === undefined) {
        type = 'success';
    }
    $('#div-alert').addClass('alert-'+type);
    $('#div-alert-title').text(title);
    $('#div-alert-span').text(msg);
    $('#div-alert').slideDown();
    setTimeout(function () {
        $('#div-alert').slideUp();
    }, 3000);
}