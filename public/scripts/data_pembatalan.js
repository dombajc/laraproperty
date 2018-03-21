var modal = $('#modal-form');
var form = $('form');
var tabel = $('#table');

$('#tgltr .input-daterange').datepicker({
    format: "dd-mm-yyyy",
    language: "id",
    autoclose: true,
    todayHighlight: true
});

$('#txttgl')
    .datepicker({
        format: 'dd-mm-yyyy',
        language: "id",
        autoclose: true,
        todayHighlight: true
    })
    .on('changeDate', function(e) {
        // Revalidate the date field
        form.formValidation('revalidateField', 'txttgl');
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_tr_batal'] + ')"><i class="fa fa-edit"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_tr_batal'] + ')"><i class="fa fa-trash"></i></button>';
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
            "targets": 4,
            "className": "text-center",
        },
        {
            "targets": 5,
            "className": "text-center",
        }
    ],
    ajax: {
        url: location.href + '/rows',
        type: 'GET',
        "data": function(data) {
            data.sByProyek = $('#cariproyek').val();
            data.sByTipe = $('#caritipe').val();
            data.sByAlamat = $('#carialamat').val();
            data.sByTglAwal = $('#txttglawal').val();
            data.sByTglAkhir = $('#txttglakhir').val();
            data.sByNama = $('#carinama').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_tr_batal", "width": "60px" },
        { "data": "tgl_batal", "width": "60px" },
        { "data": "alamat" },
        { "data": "alasan" },
        { "data": "nm_tipe", "width": "100px" },
        { "data": "nm_proyek", "width": "100px" }
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
            txtnik: {
                validators: {
                    notEmpty: {},
                }
            },
            txtnama: {
                validators: {
                    notEmpty: {},
                }
            },
            txtalamat: {
                validators: {
                    notEmpty: {},
                }
            },
            txtnohp: {
                validators: {
                    notEmpty: {},
                }
            },
            txtemail: {
                validators: {
                    emailAddress: {},
                }
            },
            txtpekerjaan: {
                validators: {
                    notEmpty: {},
                }
            },
            txttgl: {
                validators: {
                    notEmpty: {},
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Penulisan tanggal salah'
                    }
                }
            },
            txthargakesepakatan: {
                validators: {
                    notEmpty: {},
                }
            },
            slctmarketing: {
                validators: {
                    notEmpty: {},
                }
            },
            slctcarapembayaran: {
                validators: {
                    notEmpty: {},
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

$('#btn-cari').click(function(){
    datatabel.ajax.reload();
});

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal({ backdrop: 'static', keyboard: false  });
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('edit');
            $('#hid').val(result.Row.id_tr_batal);
            $('#hidpenjualan').val(result.Row.id_tr_jual);
            $('#txtnik').val(result.Row.nik);
            $('#txtnama').val(result.Row.nm_konsumen);
            $('#txtnohp').val(result.Row.no_hp);
            
            $('#txtkapling').val(result.Row.alamat_kapling);
            $('#txttipe').val(result.Row.nm_tipe);
            $('#txtproyek').val(result.Row.nm_proyek);

            $('#txttgljual').val(result.Row.tgl_jual_indo);
            $('#txttotal').val(result.Row.total_biaya);

            $('#txttgl').val(result.Row.tgl_batal_indo);
            $('#txtalasan').val(result.Row.alasan);

        } else {
            AppError(result.Msg);
        }

    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

modal.on('shown.bs.modal', function () {
    $('#txttgl').trigger('focus')
  })

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
