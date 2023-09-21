<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permission extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Role_m');
        $this->load->model('Navigation_m');
    }

    public function index()
    {
        $params = [
            'page_title' => 'Permission'
        ];
        $this->template->load('template', 'sysadmin/permission/index', $params);
    }

    public function getRole()
    {
        if ($this->input->is_ajax_request()) {
            $results = $this->Role_m->getRole();
            $data = [];
            $no = $_POST['start'];
            foreach ($results as $result) {
                $row = array();
                $row[] = ++$no;
                $row[] = '<u>' . $result->role_nm . '</u><br /> <span style="font-size: 9pt; font-weight: lighter;">' . $result->role_desc . '</span>';
                $row[] = '
                <a href="#" class="btn btn-primary btn-sm" id=' . "btnPermission" . $result->role_id . ' onclick="openPermission(' . "'" . $result->role_id . "'" . ')"><i class="las la-key la-lg"></i> Permission</a>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Role_m->count_all_role(),
                "recordsFiltered" => $this->Role_m->count_filtered_role(),
                "data" => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        } else {
            redirect($this->fungsi->user_login()->default_page);
        }
    }

    public function getPermission()
    {
        $results = $this->Navigation_m->getPermisNav();
        $array = $this->recursiveArrayMenu($results);
        $data = [];
        $no = $_POST['start'];
        foreach ($array as $result) {
            $row = array();
            $row[] = ++$no;
            if ($result->parent_id != 0) {
                $row[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="' . $result->faicon . ' la-lg"></i>&nbsp;&nbsp;&nbsp;' . $result->nav_title;
            } else {
                $row[] = '<i class="' . $result->faicon . ' la-lg"></i>&nbsp;&nbsp;&nbsp;' . $result->nav_title;
            }
            if ($result->permission == 'unlocked') {
                $row[] = '<input type="checkbox" name="nav_id[]" id="nav_id" value="' . $result->nav_id . '" checked>';
            } else {
                $row[] = '<input type="checkbox" name="nav_id[]" id="nav_id" value="' . $result->nav_id . '">';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Navigation_m->count_all_permis_nav(),
            "recordsFiltered" => $this->Navigation_m->count_filtered_permis_nav(),
            "data" => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function set_permission()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post(null, TRUE);
            if ($this->Navigation_m->setPermission($post)) {
                $msg = [
                    'success' => 'Successfully setting permission'
                ];
            } else {
                $msg = [
                    'error' => 'Failed to setting permission'
                ];
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        } else {
            redirect($this->fungsi->user_login()->default_page);
        }
    }

    private function recursiveArrayMenu($elements, $parentId = 0, $indent = NULL)
    {
        $branch = array();
        foreach ($elements as $k => $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->recursiveArrayMenu($elements, $element->nav_id, $indent);
                $branch[] = $element;
                if ($children) {
                    foreach ($children as $key => $v) {
                        $branch[] = $v;
                    }
                }
            }
        }
        return (object)$branch;
    }
}
