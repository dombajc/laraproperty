var form = $('#form');

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
            txtpass: {
                validators: {
                    notEmpty: {},
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
                    notEmpty: {},
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
        var konfirm = confirm('Halaman akan otomatis Log Out jika password baru berhasil di simpan. \nApakah anda yakin ingin mengubah password anda ?');
        if (konfirm == 1) {
            $.post(location.href + '/update_password', data, function(result) {
                if (result.Status == 1) {
                    location.href = location.href + '/success';
                } else {
                    AppError(result.Msg);
                }
            }, 'json')
            .fail(function(jqXHR, textStatus) {
                JsonError(jqXHR);
            });
        }
    });
