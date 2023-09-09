<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('cu.user_id, cu.username, cu.email, u.user_fullname, u.user_gender, u.user_birth_date, u.user_photo, u.user_address, u.user_phone, u.user_birthplace, u.user_st, cr.role_nm, cr.role_id, cr.default_page');
        $this->db->from('com_user cu');
        $this->db->join('users u', 'u.`user_id` = cu.`user_id`', 'left');
        $this->db->join('com_role_user cru', 'cru.`user_id` = cu.`user_id`', 'left');
        $this->db->join('com_role cr', 'cr.`role_id` = cru.`role_id`', 'left');
        if ($id != null) {
            $this->db->where('cu.user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    private function _get_data_query()
    {
        $this->db->from('com_user cu');
        $this->db->join('users u', 'u.`user_id` = cu.`user_id`');
        $this->db->join('com_role_user cru', 'cru.`user_id` = cu.`user_id`');
        $this->db->join('com_role cr', 'cr.`role_id` = cru.`role_id`');
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

    public function create($p)
    {
        $this->db->trans_start();

        $com_user = [
            'username' => $p['username'],
            'password' => password_hash($p['password'], PASSWORD_DEFAULT),
            'email' => $p['email'],
            'cid' => $this->fungsi->user_login()->user_id,
        ];
        $this->db->insert('com_user', $com_user);
        
        $user_id = $this->db->insert_id();

        $com_role_user = [
            'user_id' => $user_id,
            'role_id' => $p['role']
        ];
        $this->db->insert('com_role_user', $com_role_user);

        $users = [
            'user_id' => $user_id,
            'user_fullname' => $p['fullname'],
            'user_gender' => $p['gender'],
            'user_birthplace' => $p['birthplace'],
            'user_birth_date' => $p['birthday'],
            'user_address' => $p['address'],
            'user_phone' => $p['phone'],
        ];
        $this->db->insert('users', $users);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function update($p)
    {
        $this->db->trans_start();

        $com_user = [
            'username' => $p['username'],
            'email' => $p['email'],
            'cid' => $this->fungsi->user_login()->user_id,
        ];
        if($p['password'] != null){
            $com_user['password'] = password_hash($p['password'], PASSWORD_DEFAULT);
        }
        $this->db->where('user_id', $p['user_id']);
        $this->db->update('com_user', $com_user);
        

        $com_role_user = [
            'role_id' => $p['role']
        ];
        $this->db->where('user_id', $p['user_id']);
        $this->db->update('com_role_user', $com_role_user);

        $users = [
            'user_fullname' => $p['fullname'],
            'user_gender' => $p['gender'],
            'user_birthplace' => $p['birthplace'],
            'user_birth_date' => $p['birthday'],
            'user_address' => $p['address'],
            'user_phone' => $p['phone'],
        ];
        $this->db->where('user_id', $p['user_id']);
        $this->db->update('users', $users);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function delete($id)
    {
        $this->db->delete('com_user', ['user_id' => $id]);
    }
}
