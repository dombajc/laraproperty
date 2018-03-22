var getproyek = $('#fproyek');


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

$('#btn-excel').click(function(){
    location.href = location.href + "/report" + parameter() +'&jenis=excel';
});

function parameter() {
    return '?p='+ getproyek.val();
}