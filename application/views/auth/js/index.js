var formData = $('#formData');
console.log(formData)
var btnLogin = $('.btn-login');
function login() {
    $.ajax({
        type: "post",
        url: '<?= site_url("auth/process_login") ?>',
        data: formData.serialize(),
        dataType: "json",

        beforeSend: function() {
            btnLogin.attr('disabled', true);
            btnLogin.html('<i class="bx bx-fw bx-loader-alt bx-spin"></i> Tunggu');
        },

        complete: function() {
            btnLogin.attr('disabled', false);
            btnLogin.text('Login');
        },

        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: response.success,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "<?= site_url('"+response.page+"') ?>"
                    }
                })
            }
            if (response.failed) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.failed,
                })
            }
        }
    })
}