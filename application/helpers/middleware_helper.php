
<?php
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session) {
        $url = $ci->fungsi->user_login()->default_page;
        redirect($url);
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('auth');
    }
}

function checkRole($allowedRoles = array()) {
    $ci = &get_instance();

    $userRole = $ci->fungsi->user_login()->role_nm; // Gantilah 'user_role' dengan sesuai dengan struktur data pengguna Anda

    if (!in_array($userRole, $allowedRoles)) {
        // Redirect ke halaman lain jika peran pengguna tidak diizinkan
        $url = $ci->fungsi->user_login()->default_page;
        redirect($url); // Gantilah 'unauthorized_page' dengan halaman yang sesuai
    }
}
?>