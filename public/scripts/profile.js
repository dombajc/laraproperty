var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

if ( $('#uri_slctfoto').val() == '' ) {
    error_select_foto('Anda belum upload foto profile. Silahkan unggah foto anda !');
}

document.getElementById('slctfoto').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    var allowedExtensions = /(\.jpg|\.jpeg)$/i;

    if(!allowedExtensions.exec(tgt.value)){
        error_select_foto('File harus berupa gambar jpg / jpeg !');
        return false;
    }else{
        if ( document.getElementById('slctfoto').files[0].size <= 2000000 ) {
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    $('#r-slctfoto').attr('src', fr.result);
                    $('#uri_slctfoto').val(fr.result);
                }
                fr.readAsDataURL(files[0]);
            } else {
                return false;
            }
        } else {
            error_select_foto('Ukuran File melebihi maksimal upload sebesar 2M !');
            return false;
        }
    }
}

function error_select_foto(msg) {
    alert(msg);
    document.getElementById('slctfoto').value = '';
    getDataUri( pic_default , function(dataUri) {
        $('#r-slctfoto').attr('src', dataUri);
        $('#uri_slctfoto').val(dataUri);
    });    
}

function getDataUri(url, callback) {
    var image = new Image();

    image.onload = function () {
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
        canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

        canvas.getContext('2d').drawImage(this, 0, 0);

        callback(canvas.toDataURL('image/jpeg'));
    };

    image.src = url;
}

form.formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        row: {
            invalid: 'text-danger'
        },
        icon: {
            valid: '',
            invalid: '',
            validating: ''
        },
        fields: {
            txtnama: {
                validators: {
                    notEmpty: {},
                }
            }
        }
    })
    .on('err.field.fv', function(e, data) {
        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
    })
    .on('success.field.fv', function(e, data) {
        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();
        var data = form.serialize();
        var konfirm = confirm('Perbaharui Data ?');
        if (konfirm == 1) {
            $.post(location.href + '/update_profile', data, function(result) {
                if (result.Status == 1) {
                    location.reload();
                } else {
                    AppError(result.Msg);
                }
            }, 'json')
            .fail(function(jqXHR, textStatus) {
                JsonError(jqXHR);
            });
        }
    });
