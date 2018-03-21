var form = $('#form');

$('#show-maps').locationpicker({
    location: {latitude: lat, longitude: lang},
    radius: 300,
    //onchanged: function(currentLocation, radius, isMarkerDropped) {
        //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    //},
    inputBinding: {
        latitudeInput: $('#txtlat'),
        longitudeInput: $('#txtlong'),
        radiusInput: $('#us2-radius'),
        locationNameInput: $('#txtbantucari')
    },
    enableAutocomplete: true
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
            txtjudul: {
                validators: {
                    notEmpty: {},
                }
            },
            txttitle: {
                validators: {
                    notEmpty: {},
                }
            },
            txtabout: {
                validators: {
                    notEmpty: {},
                }
            },
            txtalamat: {
                validators: {
                    notEmpty: {},
                }
            },
            txttelp: {
                validators: {
                    notEmpty: {},
                }
            },
            txtemail: {
                validators: {
                    notEmpty: {},
                }
            },
            txtfax: {
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

        var konfirm = confirm('Simpan Data ?');
        if (konfirm == 1) {
            $.post( location.href + '/save', form.serialize(), function(res){
                if (res.Status == 1) {
                    location.reload();
                } else {
                    AppError(res.Msg);
                }
            }, 'json' )
            .fail(function(xhr, ajaxOptions, thrownError) {
                JsonError(xhr);
            });
        }
    });

