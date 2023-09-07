<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    public function get($id)
    {
        $this->db->select('cu.user_id, cu.username, cu.email, u.user_fullname, u.user_gender, u.user_birth_date, u.user_photo, u.user_address, u.user_phone, u.user_birthplace, u.user_st, cr.role_nm, cr.role_id, cr.default_page');
        $this->db->from('com_user cu');
        $this->db->join('users u', 'u.`user_id` = cu.`user_id`', 'left');
        $this->db->join('com_role_user cru', 'cru.`user_id` = cu.`user_id`', 'left');
        $this->db->join('com_role cr', 'cr.`role_id` = cru.`role_id`', 'left');
        $this->db->where('cu.user_id', $id);
        $query = $this->db->get();
        return $query;
    }

    private function _get_data_query()
    {
        $this->db->from('com_user cu');
        $this->db->join('users u', 'u.`user_id` = cu.`user_id`');

        if (($_POST['search']['value']) != null) {
            $this->db->or_like('u.user_fullname', $_POST['search']['value']);
        }

        $this->db->order_by('cu.user_id', 'DESC');
    }

    public function getUsers()
    {
        $this->_get_data_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_users()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_users()
    {
        $this->db->from('com_user cu');
        $this->db->join('users u', 'u.`user_id` = cu.`user_id`');
        return $this->db->count_all_results();
    }
}
