var modal = $('#modal-form');
var form = $('form');
var tabel = $('#table');

$('.number').number( true, 0 );
$(".nik").mask('0000000000000000');

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
                    '<button type="button" class="btn btn-sm btn-info" onClick="openModal(' + row['id_tr_jual'] + ')"><i class="fa fa-cart-plus"></i></button>';
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
            "className": "text-right",
        },
        {
            "targets": 5,
            "className": "text-center",
        },
        {
            "targets": 6,
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
            data.sByPembayaran = $('#caripembayaran').val();
            data.sByTglAwal = $('#txttglawal').val();
            data.sByTglAkhir = $('#txttglakhir').val();
            data.sByNama = $('#carinama').val();
            data.sByMarketing = $('#carimarketing').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_tr_jual", "width": "60px" },
        { "data": "tgl_jual" },
        { "data": "alamat" },
        { "data": "nm_konsumen", "width": "25%" },
        { "data": "total_biaya", "width": "60px" },
        { "data": "nm_tipe", "width": "60px" },
        { "data": "nm_proyek", "width": "60px" }
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
            txttgl: {
                validators: {
                    notEmpty: {},
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Penulisan tanggal salah'
                    }
                }
            },
            txtalasan: {
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
            $('#haksi').val('add');
            $('#hidpenjualan').val(result.Row.id_tr_jual);
            $('#txtnik').val(result.Row.nik);
            $('#txtnama').val(result.Row.nm_konsumen);
            $('#txtnohp').val(result.Row.no_hp);
            $('#txtkapling').val(result.Row.alamat_kapling);
            $('#txttipe').val(result.Row.nm_tipe);
            $('#txtproyek').val(result.Row.nm_proyek);
            $('#txttgljual').val(result.Row.tgl_jual);
            $('#txttotal').val(result.Row.total_biaya);

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

