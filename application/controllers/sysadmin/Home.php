<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $allowedRoles = array('System Administrator', 'Admin');
        checkRole($allowedRoles);
    }
    
    public function index()
    {
        $params = [
            'page_title' => 'Home',
        ];
        $this->template->load('template', 'sysadmin/home/index', $params);
    }
}