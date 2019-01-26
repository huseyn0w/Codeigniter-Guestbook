<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 0:49
 */

class Users_model extends CI_Model
{
    public function auth($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        if($query->num_rows() > 0) return true;
        return false;
    }
}