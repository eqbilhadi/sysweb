var formData = $('#formData')
var btnSave = $('#btnSave')
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
            "url": "<?= site_url('sysadmin/permission/getRole') ?>",
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

function openPermission(id) {
    modal.modal('show')
    $('#role_id').val(id)
    $('#tableNav').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "bDestroy": true,
        "paging": false,
        "scrollCollapse": true,
        "scrollY": '450px',
        "order": [],
        "ajax": {
            "url": "<?= site_url('sysadmin/permission/getPermission') ?>",
            "type": "POST",
            "data": function (d) {
                d.role_id = id;
                return d;
            }
        },
        "columnDefs": [
            { "targets": [0, -1], "className": "text-center" },
            { "targets": [0], "width": "6%" },
        ],
        "language": {
            "processing": 'Loading...',
        }
    })
}

function save() {
    $.ajax({
        type: "post",
        url: "<?= site_url('sysadmin/permission/set_permission') ?>",
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
                $('#tableNav').DataTable().ajax.reload()
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

modal.on('shown.bs.modal', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
});