var modal = $('#modal-form');
var form = $('#form');
var formupload = $('#uploaded');
var tabel = $('#table');
var tabelgaleri = $('#table-galeri');
var galeri = $('#modal-galeri');
var upload = $('#modal-upload');

$('.number').number( true, 0 );

$('#btn-add').click(function() {
    modal.modal({ backdrop: 'static', keyboard: false });
    $('#haksi').val('add');
    form[0].reset();
    form.formValidation('resetForm', true);
    $('#txtuser').prop('disabled', false);
    
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_tipe_proyek'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_tipe_proyek'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_tipe_proyek'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_tipe_proyek'] + ')"><span class="fa fa-close"></span></button>';
                }

                aksi += '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
        },
        {
            "targets": 1,
            "className": "text-center",
        },
        {
            "targets": 2,
            "className": "text-center",
        },
        {
            "targets": 3,
            "className": "text-right",
        },
        {
            "targets": 4,
            "className": "text-center",
        },
        {
            "targets": 5,
            "className": "text-center",
        },
        {
            "render": function(data, type, row) {
                return '<button type="button" class="btn btn-sm" onClick="openGaleri(' + row['id_tipe_proyek'] + ')" >Lihat</button>';
            },
            "targets": 6,
            "className": "text-center",
            "width" : "20px"
        }
    ],
    ajax: {
        url: location.href + '/rows',
        type: 'GET',
        "data": function(data) {
            data.sProyek = $('#filterproyek').val();
            //data.sNama = $('#f-nm').val();
            //data.sPolres = $('#f-polres').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_tipe_proyek", "width": "60px" },
        { "data": "nm_tipe" },
        { "data": "luas_bangunan", "width": "10%" },
        { "data": "harga_standar", "width": "15%" },
        { "data": "jml_unit", "width": "10%" },
        { "data": "nm_proyek", "width": "20%" }
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
            txtnama: {
                validators: {
                    notEmpty: {},
                }
            },
            slctproyek: {
                validators: {
                    notEmpty: {},
                }
            },
            txtluas: {
                validators: {
                    notEmpty: {},
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
                    }
                }
            },
            txtjmlkmrtidur: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
                    }
                }
            },
            txtjmlkmrmandi: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
                    }
                }
            },
            txtluas: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
                    }
                }
            },
            txtjmlgarasi: {
                validators: {
                    notEmpty: {},
                }
            },
            txtharga: {
                validators: {
                    notEmpty: {},
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
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
        var data = form.serialize();
        var konfirm = confirm('Simpan Data ?');
        if (konfirm == 1) {
            $.post(location.href + '/action', data, function(result) {
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

$('#filterproyek').on('change', function(){
    datatabel.ajax.reload();
});

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal({ backdrop: 'static', keyboard: false });
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('edit');
            $('#hid').val(result.Row.id_tipe_proyek);
            $('#txtnama').val(result.Row.nm_tipe);
            $('#slctproyek').val(result.Row.id_proyek);
            $('#txtluas').val(result.Row.luas_bangunan);
            $('#txtjmlkmrtidur').val(result.Row.jml_kmr_tidur);
            $('#txtjmlkmrmandi').val(result.Row.jml_kmr_mandi);
            $('#txtjmlgarasi').val(result.Row.garasi);
            $('#txtharga').val(result.Row.harga_standar);
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

$('#slctprov').on('change', function() {
    var opsikota = $('#slctkota');
    opsikota.empty();
    if ( this.value == '' ) {
        opsikota.append('<option value=""> -- Pilih Provinsi dahulu -- </option>');
    } else {
        $.get( location.href + '/findKotaByProv', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsikota.append('<option value=""> -- Pilih salah satu -- </option>')
                $.each( res, function(key,val) {
                    opsikota.append('<option value="'+ val.id_kota +'">'+ val.nm_kota +'</option>');
                });
            } else {
                opsikota.append('<option value=""> -- Tidak Ada Data Kota -- </option>');
            }

            if ( $('#haksi').val() == 'edit' ) {
                opsikota.val($('#result-kota').val());
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});

var datagaleri = tabelgaleri.DataTable({
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="jsEditImage(' + row['id_galeri_tipe'] + ')"><span class="fa fa-edit"></span></button>'
                    + '<button type="button" class="btn btn-sm btn-danger" onClick="jsDeleteImage(' + row['id_galeri_tipe'] + ')"><span class="fa fa-trash"></span></button>';
                    + '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
        },
        {
            "render": function(data, type, row) {
                var img = '<a href="unggahfiles/galeritipe/'+ row['nm_foto'] +'" data-fancybox><img src="'+ row['uri_foto'] +'" class="img-thumbnail" width="100px" height="100px"></a>';
                return img;
            },
            "targets": 1,
            "className": "text-center"
        }
    ],
    ajax: {
        url: location.href + '/pics',
        type: 'GET',
        "data": function(data) {
            data.sTipe = $('#idtipe').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_images_kapling", "width": "20px" },
        { "data": "nm_image" },
        { "data": "keterangan" }
    ]
});

function openGaleri(id) {
    galeri.modal({ backdrop: 'static', keyboard: false });
    $('#idtipe').val(id);
    datagaleri.ajax.reload(null, false);
}

$('#btn-add-upload').click(function(){
    upload.modal({ backdrop: 'static', keyboard: false });
    formupload[0].reset();
    formupload.formValidation('resetForm', true);
    $('#haksiupload').val('add');
    $('#src-foto').hide('fast');
});

formupload.formValidation({
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
        unggahfile: {
            validators: {
                callback: {
                    message: 'Silahkan pilih foto anda !',
                    callback: function(value, validator, $field) {
                        var x = formupload.find('[name="haksiupload"]').val();
                        return (x !== 'add') ? true : (value !== '');
                    }
                },
                file: {
                    extension: 'jpeg,jpg',
                    type: 'image/jpeg',
                    maxSize: 2097152,
                    message: 'Format File harus JPG / JPEG dan berukuran maksimal 2M !'
                }
            }
        },
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
    var konfirm = confirm('Simpan Data ?');
    if (konfirm == 1) {
        var formData = new FormData;

        var file_img = document.getElementById('unggahfile');
        formData.append('unggahimg', file_img.files[0]);
        formData.append('hid', $('#hidupload').val());
        formData.append('haksi', $('#haksiupload').val());
        formData.append('desc', $('#txtketerangan').val());
        formData.append('hidtipe', $('#idtipe').val());

        $.ajax({
            url: location.href + '/actionupload',
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                if (result.Status == 1) {
                    upload.modal('hide');
                    datagaleri.ajax.reload(null, false);
                } else {
                    AppError(result.Msg);
                }
            }
        })
        .fail(function(xhr, ajaxOptions, thrownError) {
            JsonError(xhr);
        });
    }
});

function jsEditImage(Id) {
    $.post(location.href + '/viewupload', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            upload.modal({ backdrop: 'static', keyboard: false });
            formupload[0].reset();
            formupload.formValidation('resetForm', true);
            $('#haksiupload').val('edit');
            $('#hidupload').val(result.Row.id_galeri_tipe);
            $('#gambar').attr('src', result.Row.uri_foto);
            $('#txtketerangan').text(result.Row.keterangan);
            $('#src-foto').show('fast');
        } else {
            AppError(result.Msg);
        }

    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

function jsDeleteImage(Id) {
    var konfirm = confirm('Yakin Data akan di Hapus ?');
    if (konfirm == 1) {
        $.post(location.href + '/actionupload', { 'hid': Id, 'haksi': 'delete' }, function(result) {
            if (result.Status == 1) {
                datagaleri.ajax.reload(null, false);
            } else {
                AppError(result.Msg);
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
}
