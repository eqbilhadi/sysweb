<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		check_already_login();
		$this->db->from('com_login');
		$data = array(
			'data' => $this->db->get()->row()
		);
		$this->load->view('auth/login',$data);
	}

	public function process_login()
	{
		if($this->input->is_ajax_request()){
			$post = $this->input->post(null, TRUE);
			$this->load->model('Auth_m', 'auth');
			$query = $this->auth->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$password = $row->password;
				if(password_verify($post['password'], $password)){
					$params = array(
						'userid' => $row->user_id
					);
					$this->session->set_userdata($params);
					$msg = [
						'success' => 'Login Berhasil',
						'page'		=> $row->default_page
					];
				} else {
					$msg = [
						'failed' => 'Login Gagal'
					];
				}
			} else {
				$msg = [
					'failed' => 'Login Gagal'
				];
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($msg));
		} else {
			echo 'tidak dapat diakses';
		}
	}

	public function logout()
    {
        $params = array('userid');
        $this->session->unset_userdata($params);
        redirect('auth');
    }
}
