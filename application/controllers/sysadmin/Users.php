<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('User_m');
        $this->load->model('Role_m');
    }

    public function index()
    {
        $role = $this->Role_m->get();
        $params = [
            'role' => $role->result_array()
        ];
        $this->template->load('template', 'sysadmin/users/index', $params);
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
            $row[] = $result->email;
            $row[] = $result->role_nm;
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

    public function create()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[com_user.username]|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            $this->form_validation->set_message('required', '%s required!');
            $this->form_validation->set_message('is_unique', '%s is already in use');

            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'username' => form_error('username'),
                        'password' => form_error('password'),
                        'email' => form_error('email'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                if ($this->User_m->create($post)) {
                    $msg = [
                        'success' => 'Added successfully'
                    ];
                } else {
                    $msg = [
                        'failed' => 'Failed to add'
                    ];
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        } else {
            echo "dilarang diakses";
        }
    }

    public function byid()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post(null, TRUE);
            $data = $this->User_m->get($post['user_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data->row()));
        } else {
            echo "dilarang diakses";
        }
    }

    public function update()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            $this->form_validation->set_message('required', '%s required!');
            $this->form_validation->set_message('is_unique', '%s is already in use');

            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'username' => form_error('username'),
                        'password' => form_error('password'),
                        'email' => form_error('email'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                if ($this->User_m->update($post)) {
                    $msg = [
                        'success' => 'Update successfully'
                    ];
                } else {
                    $msg = [
                        'failed' => 'Failed to update'
                    ];
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        } else {
            echo "dilarang diakses";
        }
    }

    public function delete()
    {
        if($this->input->is_ajax_request()){
            $post = $this->input->post(null, TRUE);
            $this->User_m->delete($post['user_id']);
            if ($this->db->affected_rows() > 0) {
                $msg = [
                    'success' => 'Delete successfully'
                ];
            } else {
                $msg = [
                    'error' => 'Failed to delete'
                ];
            }
    
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        }
    }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM com_user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '%s is already in use');
            return false;
        } else {
            return true;
        }
    }
}
