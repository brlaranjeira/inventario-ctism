/**
 * Created by brlaranjeira on 5/15/17.
 */
$.ajax('../ajax/gettipos.php', {
    method: 'get',
    dataType: 'json',
    success: function ( response ) {
        $('#tipoeqpt').autocomplete({
            source: response
            ,select: function ( event, ui ) {
                document.getElementById('tipoeqpt').value = ui.item.label;
                document.getElementById('tipoeqpt-cpy').value = ui.item.label;
                document.getElementById('idtipoeqpt').value = ui.item.id;
                $('#descricao').focus();
                return false;
            }
        });

        $('#tipoeqpt').data("ui-autocomplete")._renderItem = function ( ul, item , index ) {


            var $li = $('<li class="li-autocomplete">');

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

            var $img = $('<img class="img-responsive" width="100 px" height="100 px" />');
            $img.attr('src','../'+item.imgpath);
            $dir.append($img);

            $row.append($esq);
            $row.append($dir);

            $li.append($row);

            return $li.appendTo(ul);

        };
        $('#tipoeqpt').data("ui-autocomplete")._renderMenu = function ( ul, items ) {
            var that = this;
            $.each( items, function( index, item ) {
                that._renderItemData( ul, item );
                //that._renderItem( ul, item, index );
            });
            $( ul ).find( "li:odd" ).addClass( "li-row-odd" );
        }
    } , error: function ( response ) {
        debugger;
    }
});

var patrimonioDigitado;
function conferePatrimonio () {
    var valor = document.getElementById('patrimonio').value;
    if (patrimonioDigitado != valor) {
        patrimonioDigitado = valor;
        debugger;
        $('#div-carregar-eqpt').length &&  $('#div-carregar-eqpt').remove();
        $('#id-input').length &&  $('#id-input').remove();
        $.ajax('../ajax/consultaequipamento.php', {
            data: {patrimonio: valor},
            success: function ( json ) {
                debugger;
                if (json.length > 0) {
                    var response = JSON.parse( json );
                    var $div = $('<div id="div-carregar-eqpt"/>');
                    $div.text('Patrimônio já cadastrado (id='+response.id+')');
                    var btn = $('<button type="button" id="label-carregar-eqpt" class="btn btn-primary btn-xs"/>');
                    btn.attr('eqinfo',json);
                    btn.click(function () {
                       var equipamento = JSON.parse($(this).attr('eqinfo'));
                       debugger;
                       var $idInput = $('<input type="hidden" name="id" id="id-input"/>');
                       $idInput.attr('value',response.id);
                       $('#form-cadastro-equipamento').append($idInput);
                       document.getElementById('tipoeqpt').value = equipamento.tipo.nome;
                       document.getElementById('tipoeqpt-cpy').value = equipamento.tipo.nome;
                       document.getElementById('idtipoeqpt').value = equipamento.tipo.id;
                       document.getElementById('descricao').value = equipamento.descricao;
                       document.getElementById('numserie').value = equipamento.numserie;
                       document.getElementById('estado').value = equipamento.estado.id;
                       document.getElementById('observacao').value = equipamento.obs;
                       $('#div-carregar-eqpt').length &&  $('#div-carregar-eqpt').remove();
                    });
                    btn.text(' Carregar informações');
                    $div.append(btn);
                    $('#patrimonio').after($div);
                }
            }, error: function ( response ) {
                debugger;
            }
        });
    }
}
//$('#patrimonio').change(conferePatrimonio);
$('#patrimonio').keyup(conferePatrimonio);


$('#btn-novo-tipoeqpt').click( function () {
    var formData = new FormData(document.getElementById('form-novo-tipoeqpt'));
    $.ajax('../ajax/novotipoeqpt.php', {
        method:'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function ( response ) {
            debugger;
            response = JSON.parse(response);
            var src = $('#tipoeqpt').autocomplete('option','source');
            var novotipo = {
                desc: response.descricao,
                id: response.id,
                imgpath: response.img,
                label: response.nome,
                value: response.nome
            }
            src.push(novotipo);
            $('#tipoeqpt').autocomplete('option','source',src);
            document.getElementById('tipoeqpt').value = response.nome;
            document.getElementById('tipoeqpt-cpy').value = response.nome;
            document.getElementById('idtipoeqpt').value = response.id;
            $('#modal-add-tipoeqpt').modal('hide');
        }, error: function ( response ) {
            debugger;
        }
    })
} );

$('#btn-novoeqpt').click(function () {
    debugger;
    var copia = document.getElementById('tipoeqpt-cpy').value;
    var atual = document.getElementById('tipoeqpt').value;
    if (copia !== atual) {
        document.getElementById('tipoeqpt-nome').value = atual;
        document.getElementById('tipoeqpt-descricao').value = '';
        document.getElementById('tipoeqpt-img').value = '';
        $('#modal-add-tipoeqpt').modal('show');
    } else {
        var formData = new FormData(document.getElementById('form-cadastro-equipamento'));
        $.ajax('../ajax/novoequipamento.php', {
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function ( response )  {
                showAlert('success','Pronto!','O equipamento foi cadastrado.');
                document.getElementById('descricao').value = '';
                document.getElementById('patrimonio').value = '';
                document.getElementById('numserie').value = '';
                //document.getElementById('estado').value = document.getElementById('estado')[0].value
                document.getElementById('observacao').value = '';
                document.getElementById('foto').value = '';
            }, error: function ( response ) {
                debugger;
            }
        });
        //$('#form-cadastro-equipamento').submit();

    }
});