<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Role_m');
    }

    public function index()
    {
        $params = [
            'page_title' => 'Role',
        ];
        $this->template->load('template', 'sysadmin/role/index', $params);
    }

    public function getRole()
    {
        $results = $this->Role_m->getRole();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = '<u>'.$result->role_nm.'</u><br /> <span style="font-size: 9pt; font-weight: lighter;">'.$result->role_desc.'</span>';
            $row[] = '
			<a href="#" class="btn btn-warning btn-sm" id=' . "btnEdit" . $result->role_id . ' onclick="byid(' . "'" . $result->role_id . "','edit'" . ')"><i class="las la-edit la-lg"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id=' . "btnDelete" . $result->role_id . ' onclick="byid(' . "'" . $result->role_id . "','delete'" . ')"><i class="las la-trash la-lg"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Role_m->count_all_role(),
            "recordsFiltered" => $this->Role_m->count_filtered_role(),
            "data" => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function create()
    {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('role_nm', 'Role Name', 'required');
            $this->form_validation->set_rules('default_page', 'Default Page', 'required');

            $this->form_validation->set_message('required', '%s required!');
            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'role_nm' => form_error('role_nm'),
                        'default_page' => form_error('default_page'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                $this->Role_m->create($post);
                if ($this->db->affected_rows() > 0) {
                    $msg = [
                        'success' => 'Added successfully'
                    ];
                } else {
                    $msg = [
                        'error' => 'Failed to add'
                    ];
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        } else {
            echo "akses dilarang";
        }
    }

    public function byid()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post(null, TRUE);
            $data = $this->Role_m->get($post['role_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data->row()));
        } else {
            echo "dilarang diakses";
        }
    }

    public function update()
    {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('role_nm', 'Role Name', 'required');
            $this->form_validation->set_rules('default_page', 'Default Page', 'required');

            $this->form_validation->set_message('required', '%s required!');
            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'role_nm' => form_error('role_nm'),
                        'default_page' => form_error('default_page'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                $this->Role_m->update($post);
                if ($this->db->affected_rows() > 0) {
                    $msg = [
                        'success' => 'Updated successfully'
                    ];
                } else {
                    $msg = [
                        'error' => 'Failed to update'
                    ];
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        } else {
            echo "akses dilarang";
        }
    }

    public function delete()
    {
        if($this->input->is_ajax_request()){
            $post = $this->input->post(null, TRUE);
            $this->Role_m->delete($post['role_id']);
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
}