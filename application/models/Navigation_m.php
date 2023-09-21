<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('com_menu');
        if ($id != null) {
            $this->db->where('nav_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getIndukMenu($id = null)
    {
        $this->db->from('com_menu');
        $this->db->where('parent_id', 0);
        
        if ($id != null) {
            $this->db->where('nav_id', $id);
        }
        $this->db->order_by('nav_no', 'ASC');
        $query = $this->db->get();

        return $query;
    }

    private function _get_data_query()
    {
        $this->db->from('com_menu');
        if (($_POST['search']['value']) != null) {
            $this->db->or_like('nav_title', $_POST['search']['value']);
        }

        $this->db->order_by('parent_id', 'ASC');
        $this->db->order_by('nav_no', 'ASC');
    }

    public function getNavigation()
    {
        $this->_get_data_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_navigation()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_navigation()
    {
        $this->db->from('com_menu');
        return $this->db->count_all_results();
    }

    public function create($p)
    {
        $com_menu = [
            'parent_id' => $p['induk_menu'],
            'nav_title' => $p['nav_title'],
            'nav_desc' => $p['nav_desc'],
            'nav_url' => $p['nav_url'],
            'nav_no' => $p['nav_no'],
            'faicon' => $p['faicon'],
            'cid' => $this->fungsi->user_login()->user_id,
        ];
        $this->db->insert('com_menu', $com_menu);
    }

    public function update($p)
    {
        $com_menu = [
            'parent_id' => $p['induk_menu'],
            'nav_title' => $p['nav_title'],
            'nav_desc' => $p['nav_desc'],
            'nav_url' => $p['nav_url'],
            'nav_no' => $p['nav_no'],
            'faicon' => $p['faicon'],
            'uid' => $this->fungsi->user_login()->user_id,
            'udt' => date('Y-m-d H:i:s')
        ];
        $this->db->where('nav_id', $p['nav_id']);
        $this->db->update('com_menu', $com_menu);
    }

    
    public function delete($id)
    {
        $this->db->delete('com_menu', ['nav_id' => $id]);
    }

    //PERMISSION
    private function _get_data_permis_nav()
    {
        $this->db->select('cm.*, IF(role_id IS NULL, "locked", "unlocked") AS permission');
        $this->db->from('com_menu cm');
        $this->db->join('(SELECT * FROM com_role_menu WHERE role_id = "'.$_POST['role_id'].'") b', 'cm.nav_id = b.nav_id', 'LEFT');
        
        if (($_POST['search']['value']) != null) {
            $this->db->or_like('nav_title', $_POST['search']['value']);
        }

        $this->db->order_by('parent_id', 'ASC');
        $this->db->order_by('nav_no', 'ASC');
    }

    public function getPermisNav()
    {
        $this->_get_data_permis_nav();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_permis_nav()
    {
        $this->_get_data_permis_nav();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_permis_nav()
    {
        $this->db->from('com_menu');
        return $this->db->count_all_results();
    }

    public function setPermission($post)
    {
        $this->db->trans_start();
        
        $this->db->delete('com_role_menu', ['role_id' => $post['role_id']]);

        $params_permission = [];
        foreach ($post['nav_id'] as $k => $v) {
            $params_permission[] = array('role_id' => $post['role_id'], 'nav_id'=>$v);
        }
        $this->db->insert_batch('com_role_menu', $params_permission);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }

    }
}
