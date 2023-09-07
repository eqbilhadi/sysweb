<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('User_m');
        
    }

    public function index()
    {
        $this->template->load('template', 'sysadmin/users/index');
    }

    public function getUsers()
    {
        $results = $this->User_m->getUsers();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->username;
            $row[] = $result->user_fullname;
            $row[] = $result->user_gender == 'l' ? 'Laki-Laki' : 'Perempuan';
            $row[] = $result->user_phone;
            $row[] = $result->user_address;
            $row[] = '
			<a href="#" class="btn btn-warning btn-sm" id=' . "btnEdit" . $result->user_id . ' onclick="byid(' . "'" . $result->user_id . "','edit'" . ')"><i class="las la-edit la-lg"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id=' . "btnDelete" . $result->user_id . ' onclick="byid(' . "'" . $result->user_id . "','delete'" . ')"><i class="las la-trash la-lg"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_m->count_all_users(),
            "recordsFiltered" => $this->User_m->count_filtered_users(),
            "data" => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}