var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

$('.number').number(true,0);

$('#show-maps').locationpicker({
    location: {latitude: 46.15242437752303, longitude: 2.7470703125},
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

tinymce.init({
    selector: 'textarea',
    height: 100,
    menubar: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: 'undo redo |  bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    imagetools_proxy: 'proxy',
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'],
    setup: function(editor) {
        editor.on('keyup', function(e) {
            // Revalidate the hobbies field
            $('#tinyMCEForm').formValidation('revalidateField', 'txtisi');
        });
    }
});

$('#txtrangetgl').daterangepicker({
    "showDropdowns": true,
    "timePicker": false,
    "linkedCalendars": false,
    "showCustomRangeLabel": false,
    "opens": "center",
    "locale": {
        format: 'DD-MM-YYYY',
        cancelLabel: 'Clear'
    }
});

$('input[name="txtrangetgl"]').on('apply.daterangepicker', function(ev, picker) {
    $('#txtstart').val(picker.startDate.format('YYYY-MM-DD'));
    $('#txtend').val(picker.endDate.format('YYYY-MM-DD'));
    $(this).val( picker.startDate.format('DD-MM-YYYY') +' s.d '+ picker.endDate.format('DD-MM-YYYY') );
    form.formValidation('revalidateField', 'txtrangetgl');
});

$('input[name="txtrangetgl"]').on('cancel.daterangepicker', function(ev, picker) {
    $('#txtstart').val('');
    $('#txtend').val('');
    $(this).val('');
    form.formValidation('revalidateField', 'txtrangetgl');
});

$('#btn-add').click(function() {
    modal.modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#haksi').val('add');
    form[0].reset();
    form.formValidation('resetForm', true);
    $('#txtuser').prop('disabled', false);
    $('#r-pic-proyek,#r-pic-masterplan').hide('fast');
    $('#lihatbrosur, #hapusbrosur').attr('disabled', true);
    
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_proyek'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_proyek'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_proyek'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_proyek'] + ')"><span class="fa fa-close"></span></button>';
                }

                aksi += '</div>';
                return aksi;

            },
            "targets": 0,
            "className": "text-center"
        },
        {
            "render": function(data, type, row) {
                return row['alamat'] + '<br>Kel. ' + row['nm_kelurahan'] + ', Kec. ' + row['nm_kecamatan'] + ', ' + row['nm_kota'] + ', ' + row['nm_provinsi'];

            },
            "targets": 2,
        },
        {
            "targets": 3,
            "className": "text-right",
        },
        {
            "targets": 4,
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
        { "data": "id_proyek", "width": "12%" },
        { "data": "nm_proyek", "width": "28%" },
        { "data": "alamat", "width": "30%" },
        { "data": "luas_proyek", "width": "15%" },
        { "data": "periode", "width": "15%" }
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
            slctprov: {
                validators: {
                    notEmpty: {},
                }
            },
            slctkota: {
                validators: {
                    notEmpty: {},
                }
            },
            slctkecamatan: {
                validators: {
                    notEmpty: {},
                }
            },
            slctkelurahan: {
                validators: {
                    notEmpty: {},
                }
            },
            txtalamat: {
                validators: {
                    notEmpty: {},
                }
            },
            txtrangetgl: {
                validators: {
                    notEmpty: {}
                }
            },
            txtluas: {
                validators: {
                    notEmpty: {}
                }
            },
            filemasterplan: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg',
                        type: 'image/jpeg',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'Format Gambar salah !'
                    }
                }
            },
            gambarproyek: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg',
                        type: 'image/jpeg',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'Format Gambar salah !'
                    }
                }
            },
            filebrosur: {
                validators: {
                    file: {
                        extension: 'pdf',
                        type: 'application/pdf',
                        message: 'Format File salah !'
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
        var formData = new FormData;
        var pic_master_plane = document.getElementById('filemasterplan');
        formData.append('filemasterplan', pic_master_plane.files[0]);
        var pic_proyek = document.getElementById('gambarproyek');
        formData.append('gambarproyek', pic_proyek.files[0]);
        var file_brosur = document.getElementById('filebrosur');
        formData.append('filebrosur', file_brosur.files[0]);

        var poData = form.serializeArray();
        for (var i=0; i<poData.length; i++) {
            formData.append(poData[i].name, poData[i].value);
        }
        formData.append('txtdesc', tinyMCE.get('txtdesc').getContent());

        var konfirm = confirm('Simpan Data ?');
        if (konfirm == 1) {
            $.ajax({
                url: location.href + '/action',
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    if (result.Status == 1) {
                        modal.modal('hide');
                        onRefresh();
                    } else {
                        AppError(result.Msg);
                    }
                }
            })
            .fail(function(xhr, ajaxOptions, thrownError) {
                JsonError(xhr);
            });
            
        }
    });

function onRefresh() {
    datatabel.ajax.reload(null, false);
}

function openModal(Id) {
    $.post(location.href + '/view', { 'paramId': Id }, function(result) {
        if (result.Status == 1) {
            modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            form[0].reset();
            form.formValidation('resetForm', true);
            $('#haksi').val('edit');
            $('#hid').val(result.Row.id_proyek);
            $('#txtnama').val(result.Row.nm_proyek);
            $('#slctprov').val(result.Row.id_provinsi);
            $('#result-kota').val(result.Row.id_kota);
            $('#result-kecamatan').val(result.Row.id_kecamatan);
            $('#result-kelurahan').val(result.Row.id_kelurahan);
            $('#txtalamat').val(result.Row.alamat);
            $('#txtluas').val(result.Row.luas_proyek);
            $('#txtstart').val(result.Row.periode_mulai);
            $('#txtend').val(result.Row.periode_selesai);
            //$('#txtlat').val(result.Row.lat).trigger();
            //$('#txtlong').val(result.Row.langitute).trigger();
            
            
            $('#txtrangetgl').val(result.Row.periode_mulai_indo +' s.d '+ result.Row.periode_selesai_indo);
            if ( result.Row.desc_proyek!==null && result.Row.desc_proyek.length!== 0 ) {
                tinyMCE.get('txtdesc').setContent(result.Row.desc_proyek);
            } else {
                tinyMCE.get('txtdesc').setContent('');
            }
            $('#slctprov').change();

            if ( result.Row.uri_pic_proyek == null && result.Row.uri_pic_proyek.length==0 ) {
                $('#r-pic-proyek').hide('fast');
            } else {
                $('#r-pic-proyek').show('fast');
                $('#gambar-proyek').attr('src', result.Row.uri_pic_proyek);
            }

            if ( result.Row.uri_pic_master_plan == null || result.Row.uri_pic_master_plan.length==0 ) {
                $('#r-pic-masterplan').hide('fast');
            } else {
                $('#r-pic-masterplan').show('fast');
                $('#gambar-masterplan').attr('src', result.Row.uri_pic_master_plan);
            }

            if ( result.Row.file_brosur == null || result.Row.file_brosur.length==0 ) {
                $('#lihatbrosur, #hapusbrosur').attr('disabled', true);
                $('#r-file-brosur').val('');
            } else {
                $('#lihatbrosur, #hapusbrosur').attr('disabled', false);
                $('#r-file-brosur').val(result.Row.file_brosur);
            }
            $('#show-maps').locationpicker("location", {latitude: result.Row.lat, longitude: result.Row.langitute});
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

$('#slctprov').on('change', function() {
    var opsikota = $('#slctkota');
    opsikota.empty();
    if ( this.value == '' ) {
        opsikota.append('<option value=""> -- Pilih Provinsi dahulu -- </option>');
    } else {
        $.get( location.href + '/findKotaByProv', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsikota.append('<option value=""> -- Pilih salah satu -- </option>')
                $.each( res, function(key,val) {
                    opsikota.append('<option value="'+ val.id_kota +'">'+ val.nm_kota +'</option>');
                });
            } else {
                opsikota.append('<option value=""> -- Tidak Ada Data -- </option>');
            }

            if ( $('#haksi').val() == 'edit' ) {
                opsikota.val($('#result-kota').val());
            }

            form.formValidation('revalidateField', 'slctkota');
            $('#slctkota').change();
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});

$('#slctkota').on('change', function() {
    var opsikecamatan = $('#slctkecamatan');
    opsikecamatan.empty();
    if ( this.value == '' ) {
        opsikecamatan.append('<option value=""> -- Pilih Kota dahulu -- </option>');
    } else {
        $.get( location.href + '/findKecamatanByKota', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsikecamatan.append('<option value=""> -- Pilih salah satu -- </option>')
                $.each( res, function(key,val) {
                    opsikecamatan.append('<option value="'+ val.id_kecamatan +'">'+ val.nm_kecamatan +'</option>');
                });
            } else {
                opsikecamatan.append('<option value=""> -- Tidak Ada Data -- </option>');
            }

            if ( $('#haksi').val() == 'edit' ) {
                opsikecamatan.val($('#result-kecamatan').val());
            }
            form.formValidation('revalidateField', 'slctkecamatan');
            $('#slctkecamatan').change();
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});

$('#slctkecamatan').on('change', function() {
    var opsikelurahan = $('#slctkelurahan');
    opsikelurahan.empty();
    if ( this.value == '' ) {
        opsikelurahan.append('<option value=""> -- Pilih Kecamatan dahulu -- </option>');
    } else {
        $.get( location.href + '/findKelurahanByKecamatan', { paramId : this.value }, function( res ) {
            if( res.length > 0 ) {
                opsikelurahan.append('<option value=""> -- Pilih salah satu -- </option>')
                $.each( res, function(key,val) {
                    opsikelurahan.append('<option value="'+ val.id_kelurahan +'">'+ val.nm_kelurahan +'</option>');
                });
            } else {
                opsikelurahan.append('<option value=""> -- Tidak Ada Data -- </option>');
            }

            if ( $('#haksi').val() == 'edit' ) {
                opsikelurahan.val($('#result-kelurahan').val());
            }
            form.formValidation('revalidateField', 'slctkelurahan');
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
    
});

$('#deleteFotoMasterplan').click(function(){
    $.post(location.href + '/action', { 'hid': $('#hid').val(), 'haksi': 'delete_master_plan' }, function(result) {
        if (result.Status == 1) {
            $('#r-pic-masterplan').hide('fast');
        } else {
            AppError(result.Msg);
        }
    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
});

$('#deleteGambarTajuk').click(function(){
    $.post(location.href + '/action', { 'hid': $('#hid').val(), 'haksi': 'delete_tajuk' }, function(result) {
        if (result.Status == 1) {
            $('#r-pic-proyek').hide('fast');
        } else {
            AppError(result.Msg);
        }
    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
});

$('#lihatbrosur').click( function(){
    $.confirm({
        title: false,
        content: '<center><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" id="ani-loading"></i></center><iframe id="frame" src="unggahfiles/filebrosur/' + $('#r-file-brosur').val() + '" width="100%" height="600" style="display:none;"></iframe>',
        columnClass: 'xlarge',
        onContentReady: function() {
            $('#ani-loading').hide('fast');
            $('#frame').show('fast');
        },
        buttons: {
            SomethingElse3: {
                text: 'TUTUP',
                btnClass: 'btn-success btn-xs',
                keys: ['enter', 'Y'],
                action: function() {
                    
                }
            }
        }
    });
});

$('#hapusbrosur').click( function(){
    $.post(location.href + '/action', { 'hid': $('#hid').val(), 'haksi': 'delete_brosur' }, function(result) {
        if (result.Status == 1) {
            $('#lihatbrosur, #hapusbrosur').attr('disabled', true);
            $('#r-file-brosur').val('');
        } else {
            AppError(result.Msg);
        }
    }, 'json')
    .fail(function(jqXHR, textStatus) {
        JsonError(jqXHR);
    });
});
