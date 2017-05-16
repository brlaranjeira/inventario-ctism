/**
 * Created by brlaranjeira on 5/15/17.
 */

$.ajax('gettipos.php', {
    method: 'get',
    dataType: 'json',
    success: function ( response ) {
        $('#tipoeqpt').autocomplete({
            source: response
            ,select: function ( event, ui ) {
                document.getElementById('tipoeqpt').value = ui.item.label;
                document.getElementById('idtipoeqpt').value = ui.item.id;
                //$('#tipoeqpt').autocomplete('close');
                //$('#tipoeqpt').autocomplete('close');
                return false;
            }
        });

        $('#tipoeqpt').data("ui-autocomplete")._renderItem = function ( ul, item ) {
             var $row = $('<div class="row"/>');
             var $esq = $('<div class="col-xs-10"/>');
             var $dir = $('<div class="col-xs-2"/>');

             //$esq.text(item.label);
             var $esqR1 = $('<div class="row"/>');
             var $esqR2 = $('<div class="row"/>');
             $esq.append($esqR1);
             $esq.append($esqR2);
             $esqR1.append('<div class="col-xs-12">' + item.label + '</div>');
             $esqR2.append('<div class="col-xs-12"><small>' + item.desc + '</small></div>');

             var $img = $('<img class="img-thumbnail img-responsive" width="100 px" height="100 px" />');
             $img.attr('src',item.imgpath);
             $dir.append($img);

             $row.append($esq);
             $row.append($dir);

             return $row.appendTo(ul);

        };
        $('#tipoeqpt').data("ui-autocomplete")._renderMenu = function ( ul, items ) {
            var that = this;
            $.each( items, function( index, item ) {
                that._renderItemData( ul, item );
            });
            $( ul ).find( "li:odd" ).addClass( "odd" );
        }
    }
    , error: function ( response ) {
        debugger;
    }
});


$('#btn-novo-tipoeqpt').click( function () {
    debugger;
    var formData = new FormData(document.getElementById('form-novo-tipoeqpt'));
    $.ajax('novotipoeqpt.php', {
        method:'post',
        /*data: {
            nome: document.getElementById('tipoeqpt-nome').value,
            descricao: document.getElementById('tipoeqpt-descricao').value,
            imagem: document.getElementById('tipoeqpt-img').value
        },*/
        data: formData,
        processData: false,
        contentType: false,
        success: function ( response ) {
            debugger;
            response = JSON.parse(response);
            var $opt = $('<option/>');
            $opt.attr('value',response.id);
            $opt.text('Sala ' + response.sala.nro + ' - ' + response.cod + ' [' + response.descricao + ']');
            $('#container').append($opt);
            $('#modal-add-container').modal('hide');
            showAlert('success','Pronto!','Container adicionado com sucesso');
            $('#container').val(response.id);
        }, error: function ( response ) {
            debugger;
        }
    })
} );