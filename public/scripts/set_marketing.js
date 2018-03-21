var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_marketing'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_marketing'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_marketing'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_marketing'] + ')"><span class="fa fa-close"></span></button>';
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
            "className": "text-center",
        }
    ],
    ajax: {
        url: location.href + '/rows',
        type: 'GET',
        "data": function(data) {
            data.sByNama = $('#cariByNama').val();
            //data.sNama = $('#f-nm').val();
            //data.sPolres = $('#f-polres').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_marketing", "width": "12%" },
        { "data": "nm_marketing", "width": "28%" },
        { "data": "alamat", "width": "30%" },
        { "data": "email", "width": "15%" },
        { "data": "password_email", "width": "15%" },
        { "data": "telp", "width": "15%" }
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
            txtalamat: {
                validators: {
                    notEmpty: {},
                }
            },
            txtemail: {
                validators: {
                    emailAddress: {},
                }
            },
            txtpassemail: {
                validators: {
                    notEmpty: {},
                }
            },
            txttelp: {
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

$('#btn-cari').click( function(){
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
            $('#hid').val(result.Row.id_marketing);
            $('#txtnama').val(result.Row.nm_marketing);
            $('#txtalamat').val(result.Row.alamat);
            $('#txtemail').val(result.Row.email);
            $('#txttelp').val(result.Row.telp);

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
