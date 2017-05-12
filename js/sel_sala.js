/**
 * Created by brlaranjeira on 5/11/17.
 */


$('#form-sala').on('change', '#predio', function() {
    var idPredio = this.value;
    if (idPredio.length == 0) { //nao selecionou
        $('#sala').empty();
        $('#row-salas').addClass('hidden');
    } else {
        $.ajax('getsalas.php', {
            data: {idpredio: idPredio},
            success: function ( response ) {
                var salas = JSON.parse(response);
                $('#sala').empty();
                $('#sala').append($('<option value="">SELECIONAR</option>'));
                for (var i = 0; i < salas.length; i++) {
                    var $opt = $('<option/>');
                    $opt.attr('value',salas[i].id);
                    $opt.text(salas[i].predio.nome + '-' + salas[i].nro + ' [' + salas[i].descricao + ']');
                    $('#sala').append($opt);
                }
                $('#row-salas').removeClass('hidden');
            }, error: function ( response ) {
                alert('erro!');
                debugger;
            }
        });
    }
});

$('#form-sala').on('change', '#sala', function() {
    $('#row-submit').removeClass('hidden');
    var idSala = this.value;
    if ( idSala.length == 0 ) {

    } else {
        $.ajax('getcontainers.php', {
            data: {idsala: idSala},
            success: function ( response ) {
                debugger;
                var containers = JSON.parse(response);
                $('#container').empty();
                $('#container').append($('<option value="">Não há</option>'));
                for (var i = 0; i < containers.length; i++) {
                    var $opt = $('<option/>');
                    $opt.attr('value',containers[i].id);
                    $opt.text(containers[i].cod + ' [' + containers[i].descricao + ']');
                    $('#container').append($opt);
                }
                $('#row-containers').removeClass('hidden');
            }, error: function ( response ) {
                
            }
        });
    }
});

$('.modal-add').on('show.bs.modal', function () {
    $('input[type=text]').val('');
});

$('#btn-novo-predio').click(function () {
   $.ajax('novopredio.php', {
       method: 'post',
       data: {
           nome: document.getElementById('predio-nome').value,
           descricao: document.getElementById('predio-descricao').value
       }, success: function ( response ) {
           debugger;
           response = JSON.parse(response);
           var $opt = $('<option/>');
           $opt.attr('value',response.id);
           $opt.text(response.nome + ' [' + response.descricao + ']');
           $('#predio').append($opt);
           $('#modal-add-predio').modal('hide');
           showAlert('success','Pronto!','Prédio adicionado com sucesso');
       }, error: function ( response ) {
           
       }
   })
});