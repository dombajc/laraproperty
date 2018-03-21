var modal = $('#modal-form');
var form = $('#form');
var tabel = $('#table');

tinymce.init({
    selector: 'textarea',
    height: 200,
    menubar: false,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | removeformat | help',
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
                    '<button type="button" class="btn btn-sm btn-warning" onClick="openModal(' + row['id_berita'] + ')"><i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger" onClick="jsDelete(' + row['id_berita'] + ')"><span class="fa fa-trash"></span></button>';
                if (row['sts_aktif'] == 1) {
                    aksi += '<button type="button" class="btn btn-sm btn-success" onClick="jsValidasi(0,' + row['id_berita'] + ')"><span class="fa fa-check"></span></button>';
                } else {
                    aksi += '<button type="button" class="btn btn-sm btn-danger" onClick="jsValidasi(1,' + row['id_berita'] + ')"><span class="fa fa-close"></span></button>';
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
        { "data": "id_berita", "width": "60px" },
        { "data": "judul" },
        { "data": "kategori_berita" },
        { "data": "posted_on" },
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
            slctkategori: {
                validators: {
                    notEmpty: {},
                }
            },
            txtisi: {
                validators: {
                    callback: {
                        message: 'Isi berita harus lebih besar dari 5 huruf',
                        callback: function(value, validator, $field) {
                            // Get the plain text without HTML
                            var text = tinyMCE.activeEditor.getContent({
                                format: 'text'
                            });

                            return text.length >= 5;
                        }
                    }
                }
            },
            filegambar: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg',
                        type: 'image/jpeg',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'Format Gambar salah !'
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
        var gambar = document.getElementById('filegambar');
        formData.append('filegambar', gambar.files[0]);

        formData.append('haksi', $('#haksi').val());
        formData.append('hid', $('#hid').val());
        formData.append('txtisi', tinyMCE.get('txtisi').getContent());
        formData.append('txtnama', $('#txtnama').val());
        formData.append('slctkategori', $('#slctkategori').val());

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
            JsonError(xhr.responseText);
        });

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
            $('#hid').val(result.Row.id_berita);
            $('#slctkategori').val(result.Row.id_kategori_berita);
            $('#txtnama').val(result.Row.judul);
            tinyMCE.get('txtisi').setContent(result.Row.content);
            
            if( !result.Row.foto ) {
                $('#gambar-tajuk').attr('src', '');
                $('#show-image').hide('fast');
                $('#a-tajuk').attr('href', '');
            } else {
                $('#gambar-tajuk').attr('src', 'unggahfiles/posted/'+ result.Row.foto);
                $('#a-tajuk').attr('href', 'unggahfiles/posted/'+ result.Row.foto);
                $('#show-image').show('fast');
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

$('#deleteFotoTajuk').click( function(){
    var konfirm = confirm('Yakin Data akan di Hapus ?');
    if (konfirm == 1) {
        $.post(location.href + '/deleteFotoTajuk', { 'hid': $('#hid').val() }, function(result) {
            if (result.Status == 1) {
                $('#gambar-tajuk').attr('src', '');
                $('#show-image').hide('fast');
                $('#a-tajuk').attr('href', '');
            } else {
                AppError(result.Msg);
            }
        }, 'json')
        .fail(function(jqXHR, textStatus) {
            JsonError(jqXHR);
        });
    }
});
