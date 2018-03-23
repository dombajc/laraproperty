var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

$('.number').number(true,0);

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
                    $('#r-slctfoto').show('fast');
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
    form.formValidation('revalidateField', 'uri_slctfoto');
}

function error_select_foto(msg) {
    alert(msg);
    document.getElementById('slctfoto').value = '';
    $('#r-slctfoto').hide('fast');
}

$('#txtrangetgl').daterangepicker({
    "showDropdowns": true,
    "timePicker": false,
    "linkedCalendars": false,
    "showCustomRangeLabel": false,
    "opens": "center",
    "locale": {
        format: 'DD-MM-YYYY',
        cancelLabel: 'Clear'
    }
});

$('input[name="txtrangetgl"]').on('apply.daterangepicker', function(ev, picker) {
    $('#txtstart').val(picker.startDate.format('YYYY-MM-DD'));
    $('#txtend').val(picker.endDate.format('YYYY-MM-DD'));
    $(this).val( picker.startDate.format('DD-MM-YYYY') +' s.d '+ picker.endDate.format('DD-MM-YYYY') );
    form.formValidation('revalidateField', 'txtrangetgl');
});

$('input[name="txtrangetgl"]').on('cancel.daterangepicker', function(ev, picker) {
    $('#txtstart').val('');
    $('#txtend').val('');
    $(this).val('');
    form.formValidation('revalidateField', 'txtrangetgl');
});

$('#btn-add').click(function() {
    modal.modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#haksi').val('add');
    form[0].reset();
    form.formValidation('resetForm', true);
    $('#txtuser').prop('disabled', false);
    $('#r-pic-proyek,#r-pic-masterplan').hide('fast');
    $('#lihatbrosur, #hapusbrosur').attr('disabled', true);
    $('#r-slctfoto, #show-range-tgl').hide('fast');
    $('#slctststampil').change();
    
});

$('#slctststampil').on('change', function(){
    if ( this.value == 0 ) {
        $('#show-range-tgl').show('fast');
    } else {
        $('#show-range-tgl').hide('fast');
    }
    form.formValidation('revalidateField', 'txtrangetgl');
});

var datatabel = tabel.DataTable({
    ordering: false,
    processing: true,
    serverSide: true,
    responsive: true,
    "lengthMenu": [
        [10, 25, 50],
        [10, 25, 50]
    ],
    "columnDefs": [{
            "render": function(data, type, row) {
                var aksi = '<div class="btn-group">' +
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_slider'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_slider'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_slider'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_slider'] + ')"><span class="fa fa-close"></span></button>';
                }

                aksi += '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
        },
        {
            "render": function(data, type, row) {
                return '<img src="'+ row['uri_slider'] +'" class="img-thumbnail">' +'<br>Status Tampil : <b>'+ row['sts_tampil'] +'</b><br>'+ row['text1'] +'<br>'+ row['text2'];

            },
            "targets": 1,
        }
    ],
    ajax: {
        url: location.href + '/rows',
        type: 'GET',
        "data": function(data) {
            //data.sKode = $('#f-kode').val();
            //data.sNama = $('#f-nm').val();
            //data.sPolres = $('#f-polres').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_slider", "width": "18px" },
        { "data": "uri_slider" }
    ]
});

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
            uri_slctfoto: {
                validators: {
                    callback: {
                        message: 'Silahkan pilih gambar slider',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="haksi"]').val();
                            return (x !== 'edit') ? true : (value !== '');
                        }
                    }
                }
            },
            slctfoto: {
                validators: {
                    callback: {
                        message: 'Silahkan pilih gambar slider',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="haksi"]').val();
                            return (x !== 'add') ? true : (value !== '');
                        }
                    },
                    validators: {
                        file: {
                            extension: 'jpeg,jpg',
                            type: 'image/jpeg',
                            maxSize: 2097152,   // 2048 * 1024
                            message: 'Format Gambar salah !'
                        }
                    }
                }
            },
            slctststampil: {
                validators: {
                    notEmpty: {},
                }
            },
            txtrangetgl: {
                validators: {
                    callback: {
                        message: 'Isikan range tanggal tampil !',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="slctststampil"]').val();
                            return (x !== '0') ? true : (value !== '');
                        }
                    }
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
        var konfirm = confirm('Simpan slider ?');
        if (konfirm == 1) {
            $.post(location.href + '/action', form.serialize(), function(result) {
                if (result.Status == 1) {
                    modal.modal('hide');
                    onRefresh();
                } else {
                    AppError(result.Msg);
                }
            }, 'json')
            .fail(function(jqXHR, textStatus) {
                JsonError(jqXHR);
            });
        }

        
    });

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('edit');
            $('#hid').val(result.Row.id_slider);
            $('#r-slctfoto').attr('src', result.Row.uri_slider);
            $('#uri_slctfoto').val(result.Row.uri_slider);
            $('#slctststampil').val(result.Row.sts_tampil);
            if( result.Row.tgl_awal == '' || result.Row.tgl_akhir == '' ) {
                $('#txtrangetgl').val('');
            } else {
                $('#txtrangetgl').val(result.Row.tgl_awal + ' s.d '+ result.Row.tgl_akhir);
            }
            $('#txtstart').val(result.Row.tgl_start);
            $('#txtend').val(result.Row.tgl_end);
            $('#txttext1').val(result.Row.text1);
            $('#txttext2').val(result.Row.text2);
            $('#slctststampil').change();

        } else {
            AppError(result.Msg);
        }

    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

function openValid(Id, val) {
    $.post(location.href + '/action', { 'hid': Id, 'haksi': 'valid', 'paramVal': val }, function(result) {
        if (result.Status == 1) {
            onRefresh();
        } else {
            AppError(result.Msg);
        }
    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

function jsValidasi(val, id) {
    $.post(location.href + '/action', { 'haksi': 'valid', 'sts': val, 'hid': id }, function(result) {

            if (result.Status == 1) {
                onRefresh();
            } else {
                AppError(result.Msg);
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
}

function jsDelete(Id) {
    var konfirm = confirm('Yakin Data akan di Hapus ?');
    if (konfirm == 1) {
        $.post(location.href + '/action', { 'hid': Id, 'haksi': 'delete' }, function(result) {
            if (result.Status == 1) {
                onRefresh();
            } else {
                AppError(result.Msg);
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
}
