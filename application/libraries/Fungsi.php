<?php
class Fungsi
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_m');
        $userid = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($userid)->row();
        return $user_data;
    }

    function display_menu()
    {
        $this->ci->load->model('auth_m');
        $userid = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($userid)->row();
        $menu = $this->ci->auth_m->display_menu($user_data->role_id);
        return $menu;
    }
}
