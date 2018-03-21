var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

$('#pilihanmenu').trees({
    onCheck: {
        node: 'expand'
    },
    onUncheck: {
        node: 'collapse'
    }
});

$('#btn-add').click(function() {
    modal.modal('show');
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_user'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_user'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_user'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_user'] + ')"><span class="fa fa-close"></span></button>';
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
            //data.sKode = $('#f-kode').val();
            //data.sNama = $('#f-nm').val();
            //data.sPolres = $('#f-polres').val();
        }
    },
    "dom": '<"toolbar">rtlpi',
    "columns": [
        { "data": "id_user", "width": "12%" },
        { "data": "nm_user", "width": "28%" },
        { "data": "username", "width": "30%" },
        { "data": "pass", "width": "30%" }
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
            txtuser: {
                validators: {
                    callback: {
                        message: 'Isikan username !',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="haksi"]').val();
                            return (x !== 'add') ? true : (value !== '');
                        }
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    },
                    blank: {}
                }
            },
            txtpass: {
                validators: {
                    callback: {
                        message: 'Isikan kata sandi !',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="haksi"]').val();
                            return (x !== 'add') ? true : (value !== '');
                        }
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    }
                }
            },
            txtrepass: {
                validators: {
                    identical: {
                        field: 'txtpass',
                        message: 'Pengulangan kata sandi tidak sama !'
                    },
                    callback: {
                        message: 'Ulangi Kata Sandi !',
                        callback: function(value, validator, $field) {
                            var x = $('form').find('[name="haksi"]').val();
                            return (x !== 'add') ? true : (value !== '');
                        }
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'The username must be more than 6 and less than 30 characters long'
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

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal('show');
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('edit');
            $('#hid').val(result.Row.id_user);
            $('#txtnama').val(result.Row.nm_user);
            $('#txtuser').val(result.Row.username);
            $('#txtuser').prop('disabled', true);

            if (result.Row.hak_akses != '') {
                var exp = result.Row.hak_akses.split(',');
                $.each(exp, function(key, val) {
                    $('#chk_' + val).prop('checked', true);
                });
            }

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
