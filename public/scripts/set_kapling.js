var modal = $('#modal-form');
var galeri = $('#modal-galeri');
var form = $('#form');
var uploaded = $('#uploaded');
var tabel = $('#table');
var tabelgaleri = $('#table-galeri');

$('.number').number( true, 0 );

$('#btn-add').click(function() {
    modal.modal({ backdrop: 'static', keyboard: false });
    $('#haksi').val('add');
    form[0].reset();
    form.formValidation('resetForm', true);
    $('#slcttipe').empty();
    $('#slcttipe').append('<option value=""> -- Pilih Proyek dahulu -- </option>');
    
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_kapling_proyek'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_kapling_proyek'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_kapling_proyek'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_kapling_proyek'] + ')"><span class="fa fa-close"></span></button>';
                }

                aksi += '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
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
                if ( row['status'] == 1 ) {
                    return '<label class="text-success">Terjual</label>';
                } else {
                    return '<label class="text-danger">Belum</label>';
                }

            },
            "targets": 6,
            "className": "text-center",
        },
        {
            "render": function(data, type, row) {
                var aksi = '<button type="button" class="btn btn-sm" onClick="openGaleri(' + row['id_kapling_proyek'] + ')">Lihat</button>';
                return aksi;

            },
            "targets": 7,
            "className": "text-center",
            "width" : "40px"
        }
    ],
    ajax: {
        url: location.href + '/rows',
        type: 'GET',
        "data": function(data) {
            data.sByProyek = $('#cariproyek').val();
            data.sByTipe = $('#caritipe').val();
            data.sByAlamat = $('#carialamat').val();
            data.sByStatus = $('#caristatus').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_kapling_proyek", "width": "70px" },
        { "data": "alamat" },
        { "data": "luas_tanah", "width": "10%" },
        { "data": "harga", "width": "15%" },
        { "data": "nm_tipe", "width": "10%" },
        { "data": "nm_proyek", "width": "15%" },
        { "data": "status", "width": "10%" }
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
            txtalamat: {
                validators: {
                    notEmpty: {},
                }
            },
            slctproyek: {
                validators: {
                    notEmpty: {},
                }
            },
            slcttipe: {
                validators: {
                    notEmpty: {}
                }
            },
            txtharga: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Isikan hanya angka !'
                    }
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
            txthargaklt: {
                validators: {
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

$('#btn-cari').click(function(){
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
            $('#hid').val(result.Row.id_kapling_proyek);
            $('#txtalamat').val(result.Row.alamat);
            $('#slctproyek').val(result.Row.id_proyek);
            $('#res-tipe').val(result.Row.id_tipe_proyek);
            $('#txtharga').val(result.Row.harga);
            $('#txtluas').val(result.Row.luas_tanah);
            $('#txthargaklt').val(result.Row.harga_klt_per_meter);
            $('#txtbiayalain').val(result.Row.biaya_lain);
            $('#txtketbiayalain').val(result.Row.ket_biaya_lain);
            $('#slctproyek').change();

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

$('#slctproyek').on('change', function() {
    var opsitipe = $('#slcttipe');
    opsitipe.empty();
    if ( this.value == '' ) {
        opsitipe.append('<option value=""> -- Pilih Proyek dahulu -- </option>');
    } else {
        $.get( location.href + '/findTipeByProyek', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsitipe.append('<option value=""> -- Pilih salah satu -- </option>')
                $.each( res, function(key,val) {
                    opsitipe.append('<option value="'+ val.id_tipe_proyek +'">'+ val.nm_tipe +'</option>');
                });
            } else {
                opsitipe.append('<option value=""> -- Tidak Ada Data Tipe -- </option>');
            }

            if ( $('#haksi').val() == 'edit' ) {
                opsitipe.val($('#res-tipe').val());
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});

$('#cariproyek').on('change', function() {
    var opsitipe = $('#caritipe');
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

function openGaleri(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            galeri.modal({ backdrop: 'static', keyboard: false });
            $('#idkapling').val(result.Row.id_kapling_proyek);
            datagaleri.ajax.reload(null, false);
        } else {
            AppError(result.Msg);
        }

    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

uploaded.formValidation({
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
                notEmpty: {},
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
        formData.append('idkapling', $('#idkapling').val());
        formData.append('haksi', 'add');

        $.ajax({
            url: location.href + '/upload',
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                if (result.Status == 1) {
                    alert('Upload berhasil !');
                    uploaded[0].reset();
                    uploaded.formValidation('resetForm', true);
                    $('#nav-tab a:first').tab({ backdrop: 'static', keyboard: false });
                    datagaleri.ajax.reload(null, false);
                } else {
                    AppError(result.Msg);
                }
            }
        })
        .fail(function(xhr, ajaxOptions, thrownError) {
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
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDeleteImage(' + row['id_images_kapling'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_default'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsDefault(1,' + row['id_images_kapling'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsDefault(1,' + row['id_images_kapling'] + ')"><span class="fa fa-close"></span></button>';
                }

                aksi += '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
        },
        {
            "render": function(data, type, row) {
                var img = '<a href="unggahfiles/kapling/'+ row['nm_image'] +'" data-fancybox><img src="unggahfiles/kapling/'+ row['nm_image'] +'" class="img-thumbnail" width="100px" height="100px"></a>';

                return img;

            },
            "targets": 1,
            "className": "text-center"
        }
    ],
    ajax: {
        url: location.href + '/galeri',
        type: 'GET',
        "data": function(data) {
            data.sKapling = $('#idkapling').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_images_kapling", "width": "70px" },
        { "data": "nm_image" }
    ]
});

function jsDefault(val, id) {
    $.post(location.href + '/upload', { 'haksi': 'valid', 'sts': val, 'hid': id }, function(result) {

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

function jsDeleteImage(Id) {
    var konfirm = confirm('Yakin Foto akan di Hapus ?');
    if (konfirm == 1) {
        $.post(location.href + '/upload', { 'hid': Id, 'haksi': 'delete' }, function(result) {
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