var form = $('#form');

form.formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        icon: {
            valid: '',
            invalid: '',
            validating: ''
        },
        row: {
            valid: 'field-success',
            invalid: 'field-error'
        },
        locale: 'id_ID',
        fields: {
            txtuser: {
                validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'NRP tidak boleh kurang dari 6 dan lebih dari 25 huruf'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Isikan dengan huruf, angka, . and _'
                    }
                }
            },
            txtpass: {
                validators: {
                    notEmpty: {}
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
        $.ajax({
                url: location.href + '/checklogin',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                //async: false,
                success: function(result) {
                    if (result.Status == 1) {
                        location.href = result.Next;
                    } else if (result.Status == 9) {
                        $('#txtpass').val('');
                        $('#txtpass').focus();
                        form.formValidation('revalidateField', 'txtpass');
                        AppError(result.Msg);
                    } else {
                        form[0].reset();
                        form.data('formValidation').resetForm();
                        $('#txtuser').focus();
                        AppError(result.Msg);
                    }
                }
            })
            .fail(function(jqXHR, textStatus) {
                JsonError(jqXHR);
            });
    });

function AppError(pesan) {
    alert(pesan);
}
function JsonError(pesan) {
    var msg = "Status: " + pesan.status + " (" + pesan.statusText + ")";
    alert(msg);
}