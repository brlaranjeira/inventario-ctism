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
                debugger;
                document.getElementById('tipoeqpt').value = ui.item.label;
                document.getElementById('idtipoeqpt').value = ui.item.id;
                //$('#tipoeqpt').autocomplete('close');
                //$('#tipoeqpt').autocomplete('close');
                return false;
            }
        })
        .data("ui-autocomplete")._renderItem = function ( ul, item ) {
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

            var $img = $('<img class="img-thumbnail" />');
            $img.attr('src',item.imgpath);
            $dir.append($img);

            $row.append($esq);
            $row.append($dir);

            return $row.appendTo(ul);

            /*
            return $( "<li>" )
                .attr( "data-value", item.desc )
                .append( item.desc )
                .appendTo( ul );
            */
        }

    }, error: function ( response ) {
        debugger;
    }
});

