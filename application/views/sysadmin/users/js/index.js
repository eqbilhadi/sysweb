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
    $('#index').show()
    $('#formulir').hide()
}