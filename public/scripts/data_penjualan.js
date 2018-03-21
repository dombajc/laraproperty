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

$('#txttgl, #txttglwawancara, #txttglsp3k, #txttglakad')
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

$('#btn-add').click(function() {
    modal.modal({ backdrop: 'static', keyboard: false  });
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_tr_jual'] + ')"><i class="fa fa-edit"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_tr_jual'] + ')"><i class="fa fa-trash"></i></button>';
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
        },
        {
            "targets": 6,
            "className": "text-right",
        },
        {
            "targets": 7,
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
        { "data": "id_tr_jual", "width": "30px" },
        { "data": "tgl_jual", "width": "12%" },
        { "data": "nm_konsumen" },
        { "data": "alamat", "width": "7%" },
        { "data": "nm_tipe", "width": "15%" },
        { "data": "nm_proyek", "width": "15%" },
        { "data": "total_biaya", "width": "15%" },
        { "data": "cara_pembayaran", "width": "15%" }
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
            txttglwawancara: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Penulisan tanggal salah'
                    }
                }
            },
            txttglsp3k: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Penulisan tanggal salah'
                    }
                }
            },
            txttglakad: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Penulisan tanggal salah'
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
            $('#hid').val(result.Row.id_tr_jual);
            $('#txtnik').val(result.Row.nik);
            $('#txtnama').val(result.Row.nm_konsumen);
            $('#txtalamat').val(result.Row.alamat);
            $('#txtemail').val(result.Row.email);
            $('#txtnohp').val(result.Row.no_hp);
            $('#txtpekerjaan').val(result.Row.pekerjaan);
            
            $('#txtidkapling').val(result.Row.id_kapling_proyek);
            $('#txtkapling').val(result.Row.alamat);
            $('#txttipe').val(result.Row.nm_tipe);
            $('#txtluasbangunan').val(result.Row.luas_bangunan);
            $('#txtluastanah').val(result.Row.luas_tanah);
            $('#txtklt').text(result.Row.luas_tanah - result.Row.luas_bangunan);

            $('#txttgl').val(result.Row.tgl_jual_indo);
            $('#txthargakesepakatan').val(result.Row.harga_sepakat);
            $('#txthargaklt').val(result.Row.harga_klt_per_meter);
            $('#txtpenambahan').val(result.Row.penambahan_lain);
            $('#txtbiayatambahan').val(result.Row.biaya_penambahan);
            $('#slctmarketing').val(result.Row.id_marketing);
            $('#slctcarapembayaran').val(result.Row.id_cara_pembayaran);

            $('#txtketbiayalain').val(result.Row.ket_biaya_lain);
            $('#txtbiayalain').val(result.Row.biaya_lain);

            $('#slctcarapembayaran').change();

            if ( $('#slctcarapembayaran').val() == '001' ) {
                $('#txttglwawancara').val(result.Row.tgl_wawancara_indo);
                $('#txttglsp3k').val(result.Row.tgl_sp3k_indo);
                $('#txttglakad').val(result.Row.tgl_akad_indo);
            }

            $('.number').keyup();
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

$('.number').on('keyup', function() {
    var sum = 0;
    $('.hitung').each(function(){
        sum += parseFloat(!$(this).val() ? 0 : $(this).val());
    });
    sum += $('#txtklt').text()*$('#txthargaklt').val();
    
    $('#txttotal').val(sum);
});

$('#slctcarapembayaran').on('change', function(){
    if ( this.value == '001' ) {
        $('.input-kredit').show('fast');
    } else {
        $('.input-kredit').hide('fast');
    }
});
