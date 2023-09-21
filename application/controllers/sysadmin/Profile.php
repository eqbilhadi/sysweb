<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('User_m');
        $this->load->model('Auth_m');
    }

    public function index()
    {
        $data = $this->User_m->get($this->fungsi->user_login()->user_id);
        $params = array(
            'data' => $data->row(),
            'page_title' => 'Profile'
        );
        $this->template->load('template', 'sysadmin/profile/index', $params);
    }
    
    public function test()
    {
        $this->template->load('template', 'sysadmin/profile/test');
    }
}