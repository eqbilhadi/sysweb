<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('com_role');
        if($id != null){
            $this->db->where('role_id', $id);
        } 
        $query = $this->db->get();
        return $query;
    }
}