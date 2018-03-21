var modal = $('#modal-form');
var form = $('form');
var tabel = $('#table');

$('.number').number( true, 0 );
$(".nik").mask('0000000000000000');

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
                    '<button type="button" class="btn btn-sm btn-info" onClick="openModal(' + row['id_kapling_proyek'] + ')"><i class="fa fa-cart-plus"></i></button>';
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
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_tr_jual", "width": "5%" },
        { "data": "alamat", "width": "28%" },
        { "data": "luas_bangunan", "width": "7%" },
        { "data": "luas_tanah", "width": "7%" },
        { "data": "harga", "width": "15%" },
        { "data": "nm_tipe", "width": "15%" },
        { "data": "nm_proyek", "width": "15%" }
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

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal({ backdrop: 'static', keyboard: false });
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('add');
            $('#txtidkapling').val(result.Row.id_kapling_proyek);
            $('#txtkapling').val(result.Row.alamat);
            $('#txttipe').val(result.Row.nm_tipe);
            $('#txtluasbangunan').val(result.Row.luas_bangunan);
            $('#txtluastanah').val(result.Row.luas_tanah);
            $('#txthargakesepakatan').val(result.Row.harga);
            $('#txtklt').text(result.Row.luas_tanah - result.Row.luas_bangunan);
            $('#txthargaklt').val(result.Row.harga_klt_per_meter);
            $('#txtketbiayalain').val(result.Row.ket_biaya_lain);
            $('#txtbiayalain').val(result.Row.biaya_lain);

            $('.number').keyup();
        } else {
            AppError(result.Msg);
        }

    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
}

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

$('.number').on('keyup', function() {
    var sum = 0;
    $('.hitung').each(function(){
        sum += parseFloat(!$(this).val() ? 0 : $(this).val());
    });
    sum += $('#txtklt').text()*$('#txthargaklt').val();
    
    $('#txttotal').val(sum);
});
