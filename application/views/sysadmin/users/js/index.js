var formData = $('#formData')
var btnSave = $('#btnSave')
var saveData

// sweetalert
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$(document).ready(function () {
    $('#test').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "order": [],
        "ajax": {
            "url": "<?= site_url('sysadmin/users/getUsers') ?>",
            "type": "POST"
        },
        "columnDefs": [
            { "targets": [0, -1, -2], "className": "text-center" },
            { "targets": [0], "width": "6%" },
        ],
        "language": {
            "processing": 'Loading...',
        }
    })
})

function add() {
    $('#index').hide()
    $('#formulir').show()
    $('#title-form').text('ADD USERS')
    saveData = 'add'
}

function back() {
    resetAll()
    $('#index').show()
    $('#formulir').hide()
}

function save() {
    if(saveData == 'add'){
        url = "<?= site_url('sysadmin/users/create') ?>"
    } else if (saveData == 'edit'){
        url = "<?= site_url('sysadmin/users/update') ?>"
    }

    $.ajax({
        type: "post",
        url: url,
        data: formData.serialize(),
        dataType: "json",

        beforeSend: function () {
            btnSave.attr('disabled', true);
            btnSave.html('<i class="bx bx-fw bx-loader-alt bx-spin"></i> Waiting');
        },

        complete: function () {
            btnSave.attr('disabled', false);
            btnSave.text('Save');
        },

        success: function (response) {
            if (response.success) {
                Toast.fire({
                    icon: 'success',
                    title: response.success
                })
                back()
                $('#test').DataTable().ajax.reload()
            }
            if (response.failed) {
                Toast.fire({
                    icon: 'error',
                    title: response.failed
                })
            }
            if (response.validation) {
                $.each(response.validation, function (key, value) {
                    if (value) {
                        $('#' + key).addClass('is-invalid');
                        $('.msg_' + key).html(value);
                    } else {
                        $('#' + key).removeClass('is-invalid');
                        $('.msg_' + key).html('');
                    }
                });
            }
        }
    })
}

function byid(id, type) {
    resetAll()
    if (type == 'edit') {
        saveData = 'edit';
    }

    $.ajax({
        type: "POST",
        url: "<?= site_url('sysadmin/users/byid') ?>",
        data: {
            user_id: id
        },
        dataType: "JSON",

        beforeSend: function() {
            if (type == 'edit') {
                $('#btnEdit' + id).attr('disabled', true);
                $('#btnEdit' + id).html('<i class="bx bx-fw bx-loader-alt bx-spin"></i>');
            }
            if (type == 'delete') {
                $('#btnDelete' + id).attr('disabled', true);
                $('#btnDelete' + id).html('<i class="bx bx-fw bx-loader-alt bx-spin"></i>');
            }
        },

        complete: function() {
            if (type == 'edit') {
                $('#btnEdit' + id).attr('disabled', false);
                $('#btnEdit' + id).html('<i class="las la-edit la-lg"></i>');
            }
        },

        success: function(response) {
            if (type == 'edit') {
                $('#index').hide()
                $('#formulir').show()
                $('#title-form').text('EDIT USERS')
                $('#user_id').val(response.user_id);
                $('#username').val(response.username);
                $('#fullname').val(response.user_fullname);
                $('#email').val(response.email);
                $('#birthplace').val(response.user_birthplace);
                $('#birthday').val(response.user_birth_date);
                $('#phone').val(response.user_phone);
                $('#address').val(response.user_address);
                $("input[name=gender][value=" + response.user_gender + "]").prop('checked', true);
                $("select").val(response.role_id);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin hapus user "'+response.username+'" ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteData(response.user_id);
                    } else if (result.isDismissed) {
                        $('#btnDelete' + id).attr('disabled', false);
                        $('#btnDelete' + id).html('<span class="las la-trash la-lg"></span>');
                    }
                });
            }
        }
    })
}

function deleteData(id) {
    $.ajax({
        type: "POST",
        url: "<?= site_url('sysadmin/users/delete') ?>",
        data: {
            user_id: id
        },
        dataType: "JSON",
        success: function(response) {
            $('#btnDelete' + id).attr('disabled', false);
            $('#btnDelete' + id).html('<span class="las la-trash la-lg"></span>');
            if (response.success) {
                $('#test').DataTable().ajax.reload()
                Toast.fire({
                    icon: 'success',
                    text: response.success,
                })
            } else {
                $('#test').DataTable().ajax.reload()
                Toast.fire({
                    icon: 'error',
                    text: response.error,
                })
            }
        }
    })
}

function resetAll() {
    formData[0].reset()
    var searchParams = new URLSearchParams(formData.serialize());

    var item = {};
    searchParams.forEach(function (value, key) {
        item[key] = value;
    });

    $.each(item, function (i, v) {
        $('#' + i).removeClass('is-invalid');
        $('.msg_' + i).html('');
    })
}