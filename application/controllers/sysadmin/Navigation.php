<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Navigation_m');
    }

    public function index()
    {
        $induk_menu = $this->Navigation_m->getIndukMenu()->result_array();
        $params = [
            'page_title' => 'Navigation',
            'induk_menu' => $induk_menu
        ];
        $this->template->load('template', 'sysadmin/navigation/index', $params);
    }

    public function getNavigation()
    {
        $results = $this->Navigation_m->getNavigation();
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
            $row[] = $result->nav_url;
            $row[] = $result->nav_no;
            $row[] = '<a href="#" class="btn btn-warning btn-sm" id=' . "btnEdit" . $result->nav_id . ' onclick="byid(' . "'" . $result->nav_id . "','edit'" . ')"><i class="las la-edit la-lg"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" id=' . "btnDelete" . $result->nav_id . ' onclick="byid(' . "'" . $result->nav_id . "','delete'" . ')"><i class="las la-trash la-lg"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Navigation_m->count_all_navigation(),
            "recordsFiltered" => $this->Navigation_m->count_filtered_navigation(),
            "data" => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function create()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nav_title', 'Menu title', 'required');
            $this->form_validation->set_rules('nav_url', 'Menu URL', 'required');
            $this->form_validation->set_rules('nav_no', 'Order', 'required');
            $this->form_validation->set_rules('faicon', 'Menu Icon', 'required');

            $this->form_validation->set_message('required', '%s required!');
            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'nav_title' => form_error('nav_title'),
                        'nav_url' => form_error('nav_url'),
                        'nav_no' => form_error('nav_no'),
                        'faicon' => form_error('faicon'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                $this->Navigation_m->create($post);
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

    public function update()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nav_title', 'Menu title', 'required');
            $this->form_validation->set_rules('nav_url', 'Menu URL', 'required');
            $this->form_validation->set_rules('nav_no', 'Order', 'required');
            $this->form_validation->set_rules('faicon', 'Menu Icon', 'required');

            $this->form_validation->set_message('required', '%s required!');
            if ($this->form_validation->run() == FALSE) {
                $msg = [
                    'validation' => [
                        'nav_title' => form_error('nav_title'),
                        'nav_url' => form_error('nav_url'),
                        'nav_no' => form_error('nav_no'),
                        'faicon' => form_error('faicon'),
                    ]
                ];
            } else {
                $post = $this->input->post(null, TRUE);
                $this->Navigation_m->update($post);
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

    public function byid()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post(null, TRUE);
            $data = $this->Navigation_m->get($post['nav_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data->row()));
        } else {
            echo "dilarang diakses";
        }
    }

    public function delete()
    {
        if($this->input->is_ajax_request()){
            $post = $this->input->post(null, TRUE);
            $this->Navigation_m->delete($post['nav_id']);
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
