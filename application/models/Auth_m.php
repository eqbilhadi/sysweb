<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{
    public function login($post)
    {
        $this->db->select('u.user_fullname, u.user_gender, u.user_photo, u.user_gender, cr.role_nm, cr.default_page, cu.password, cu.user_id');
        $this->db->from('com_user cu');
        $this->db->join('users u', 'cu.`user_id` = cu.`user_id`', 'left');
        $this->db->join('com_role_user cru', 'cru.`user_id` = cu.`user_id`');
        $this->db->join('com_role cr', 'cr.`role_id` = cru.`role_id`');
        $this->db->where('username', $post['username']);
        $query = $this->db->get();
        return $query;
    }

    public function display_menu($role_id)
    {
        $cleaned_uri = $this->uri->uri_string();
        $menu = $this->get_menu($role_id);
        $menu_display = '';
        foreach ($menu->result_array() as $key => $value) {
            $sub_menu = $this->get_submenu($value['nav_id'], $role_id)->result_array();
            if (empty($sub_menu)) {
                if (str_contains($cleaned_uri, $value['nav_url'])) {
                    $menu_display .= '  <li class="nav-item">
                                            <a class="nav-link menu-link active" href="' . site_url($value["nav_url"]) . '">
                                                <i class="' . $value['faicon'] . '"></i> <span data-key="t-' . strtolower($value['nav_title']) . '">' . $value['nav_title'] . '</span>
                                            </a>
                                        </li>';
                } else {
                    $menu_display .= '  <li class="nav-item">
                                            <a class="nav-link menu-link" href="' . site_url($value["nav_url"]) . '">
                                                <i class="' . $value['faicon'] . '"></i> <span data-key="t-' . strtolower($value['nav_title']) . '">' . $value['nav_title'] . '</span>
                                            </a>
                                        </li>';
                }
            } else {
                foreach ($sub_menu as $keyword) {
                    $pos = strpos($cleaned_uri, $keyword['nav_url']);
                    if ($pos !== false) {
                        $cek_aktif = true;
                    }
                }
                if (isset($cek_aktif)) {
                    $menu_display .= '<li class="nav-item">
                                            <a class="nav-link menu-link active" href="#' . $value['nav_title'] . $value['nav_id'] . '" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="' . $value['nav_title'] . $value['nav_id'] . '">
                                                <i class="' . $value['faicon'] . '"></i> <span data-key="t-' . strtolower($value['nav_title']) . '">' . $value['nav_title'] . '</span>
                                            </a>
                                            <div class="collapse menu-dropdown show" id="' . $value['nav_title'] . $value['nav_id'] . '">
                                                <ul class="nav flex-column">';
                    foreach ($sub_menu as $k => $v) {
                        if (str_contains($cleaned_uri, $v['nav_url'])) {
                            $menu_display .= '<li class="nav-item" style="margin-left: 10px;">
                                                <a href="' . site_url($v["nav_url"]) . '" class="nav-link nav-sm active" data-key="t-' . strtolower($v['nav_title']) . '"> <i class="' . $v['faicon'] . '"></i>' . $v['nav_title'] . '</a>
                                            </li>';
                        } else {
                            $menu_display .= '<li class="nav-item" style="margin-left: 10px;">
                                                    <a href="' . site_url($v["nav_url"]) . '" class="nav-link nav-sm" data-key="t-' . strtolower($v['nav_title']) . '"> <i class="' . $v['faicon'] . '"></i>' . $v['nav_title'] . '</a>
                                                </li>';
                        }
                    }
                    $menu_display .= '</ul>
                                </div>
                            </li>';
                } else {
                    $menu_display .= '<li class="nav-item">
                                            <a class="nav-link menu-link" href="#' . $value['nav_title'] . $value['nav_id'] . '" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="' . $value['nav_title'] . $value['nav_id'] . '">
                                                <i class="' . $value['faicon'] . '"></i> <span data-key="t-' . strtolower($value['nav_title']) . '">' . $value['nav_title'] . '</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="' . $value['nav_title'] . $value['nav_id'] . '">
                                                <ul class="nav flex-column">';
                    foreach ($sub_menu as $k => $v) {
                        $menu_display .= '<li class="nav-item" style="margin-left: 10px;">
                                                <a href="' . site_url($v["nav_url"]) . '" class="nav-link nav-sm" data-key="t-' . strtolower($v['nav_title']) . '"> <i class="' . $v['faicon'] . '"></i>' . $v['nav_title'] . '</a>
                                            </li>';
                    }
                    $menu_display .= '</ul>
                                </div>
                            </li>';
                }
            }
        }
        return $menu_display;
    }

    private function get_menu($id)
    {
        $this->db->select('a.*');
        $this->db->from('com_menu a');
        $this->db->join('com_role_menu b', 'a.nav_id = b.nav_id');
        $this->db->where('b.role_id', $id);
        $this->db->where('a.parent_id', 0);
        $this->db->order_by('nav_no', 'asc');

        $query = $this->db->get();
        return $query;
    }

    private function get_submenu($id, $role_id)
    {
        $this->db->from('com_menu a');
        $this->db->join('com_role_menu b', 'a.nav_id = b.nav_id');
        $this->db->where('a.parent_id', $id);
        $this->db->where('b.role_id', $role_id);
        $this->db->order_by('nav_no', 'asc');
        $query = $this->db->get();
        return $query;
    }
}
