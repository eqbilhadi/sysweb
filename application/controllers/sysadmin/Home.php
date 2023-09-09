<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $allowedRoles = array('System Administrator');
        check_not_login();
        checkRole($allowedRoles);
    }
    
    public function index()
    {
        $this->template->load('template', 'sysadmin/home/index');
    }
}