
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
?>