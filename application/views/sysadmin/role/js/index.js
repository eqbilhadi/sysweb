var formData = $('#formData')
var btnSave = $('#btnSave')
var saveData
var modal = $('#myModalForm')

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
            "url": "<?= site_url('sysadmin/role/getRole') ?>",
            "type": "POST"
        },
        "columnDefs": [
            { "targets": [0, -1], "className": "text-center" },
            { "targets": [0], "width": "6%" },
        ],
        "language": {
            "processing": 'Loading...',
        }
    })
})

function add() {
    modal.modal('show')
    $('#myModalLabel').text('Add Role')
    saveData = 'add'
}

function save() {
    if(saveData == 'add'){
        url = "<?= site_url('sysadmin/role/create') ?>"
    } else if (saveData == 'edit'){
        url = "<?= site_url('sysadmin/role/update') ?>"
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
                modal.modal('hide')
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
        url: "<?= site_url('sysadmin/role/byid') ?>",
        data: {
            role_id: id
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
                modal.modal('show')
                $('#myModalLabel').text('Edit Role')
                $('#role_id').val(response.role_id);
                $('#role_nm').val(response.role_nm);
                $('#role_desc').val(response.role_desc);
                $('#default_page').val(response.default_page);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin hapus user "'+response.role_nm+'" ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteData(response.role_id);
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
        url: "<?= site_url('sysadmin/role/delete') ?>",
        data: {
            role_id: id
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

modal.on('hidden.bs.modal', function(e) {
    resetAll()
})

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