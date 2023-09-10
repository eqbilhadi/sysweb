<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('com_role');
        if ($id != null) {
            $this->db->where('role_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    private function _get_data_query()
    {
        $this->db->from('com_role');
        if (($_POST['search']['value']) != null) {
            $this->db->or_like('role_nm', $_POST['search']['value']);
        }

        $this->db->order_by('role_id', 'DESC');
    }

    public function getRole()
    {
        $this->_get_data_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_role()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_role()
    {
        $this->db->from('com_role');
        return $this->db->count_all_results();
    }

    public function create($p)
    {
        $com_role = [
            'role_nm' => $p['role_nm'],
            'role_desc' => $p['role_desc'],
            'default_page' => $p['default_page'],
            'cid' => $this->fungsi->user_login()->user_id,
        ];
        $this->db->insert('com_role', $com_role);
    }

    public function update($p)
    {
        $com_role = [
            'role_nm' => $p['role_nm'],
            'role_desc' => $p['role_desc'],
            'default_page' => $p['default_page'],
            'uid' => $this->fungsi->user_login()->user_id,
            'udt' => date('Y-m-d H:i:s')
        ];
        $this->db->where('role_id', $p['role_id']);
        $this->db->update('com_role', $com_role);
    }

    
    public function delete($id)
    {
        $this->db->delete('com_role', ['role_id' => $id]);
    }
}
