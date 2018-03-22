var getproyek = $('#fproyek');
var gettipe = $('#ftipe');
var getstart = $('#ftglstart');
var getend = $('#ftglend');
var getmarketing = $('#fmarketing');
var getcara = $('#fcarabayar');
var opsiproyek = $('#fproyek');
var opsitipe = $('#ftipe');

$('.input-daterange').datepicker({
    format: "dd-mm-yyyy",
    language: "id",
    autoclose: true,
    todayHighlight: true
});

opsiproyek.on('change', function() {
    opsitipe.empty();
    if ( this.value == '' ) {
        opsitipe.append('<option value=""> -- Keseluruhan -- </option>');
    } else {
        $.get( location.href + '/findTipeByProyek', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsitipe.append('<option value=""> -- Keseluruhan -- </option>')
                $.each( res, function(key,val) {
                    opsitipe.append('<option value="'+ val.id_tipe_proyek +'">'+ val.nm_tipe +'</option>');
                });
            } else {
                opsitipe.append('<option value=""> -- Keseluruhan -- </option>');
            }

        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});


$('#btn-preview').click(function(){
    var ifr=$('<iframe/>', {
        id:'MainPopupIframe',
        frameborder:0,
        src: location.href + "/report" + parameter() +'&jenis=preview',
        style:'display:none;width:100%;height:600px;overflow:scroll',
        load:function(){
            //$(this).show();
            $(this).show(function () {
                $('#loadingMessage').css('display', 'none');
            });
        }
    });
    $('#show-laporan').html(ifr);
});

$('#btn-pdf').click(function(){
    var ifr=$('<iframe/>', {
        id:'MainPopupIframe',
        frameborder:0,
        src: location.href + "/report" + parameter() +'&jenis=pdf',
        style:'display:none;width:100%;height:600px;overflow:scroll',
        load:function(){
            //$(this).show();
            $(this).show(function () {
                $('#loadingMessage').css('display', 'none');
            });
        }
    });
    $('#show-laporan').html(ifr);
});

$('#btn-excel').click(function(){
    location.href = location.href + "/report" + parameter() +'&jenis=excel';
});

function parameter() {
    return '?p='+ getproyek.val() +'&t='+ gettipe.val() +'&s='+ getstart.val() +'&e='+ getend.val();
}