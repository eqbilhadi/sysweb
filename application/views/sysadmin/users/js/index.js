var formData = $('#formData')
var btnSave = $('#btnSave')

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
            { "targets": [0, -1], "className": "text-center" },
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
}

function back() {
    resetAll()
    $('#index').show()
    $('#formulir').hide()
}

function save() {
    $.ajax({
        type: "post",
        url: "<?= site_url('sysadmin/users/create') ?>",
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