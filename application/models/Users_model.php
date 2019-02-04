<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 0:49
 */

class Users_model extends CI_Model
{

    public function update_user_data($username, $email, $fullname, $avatar_url = null)
    {
        if(!is_logged_in()) return false;

        $current_username = get_current_username();

        $id = null;


        $this->db->where('username', $current_username);
        $this->db->select('id');
        $query1 = $this->db->get('users');

        if($query1->num_rows() === 1) {

            global $id;

            $id = $query1->result();

            $id = $id[0]->id;

        }

        $updated_data = [
            'username'   => $username,
            'email'      => $email,
            'fullname'   => $fullname
        ];

        if(!is_null($avatar_url)){
            $updated_data['avatar_url'] = $avatar_url;
        }

        $this->db->where('id', $id);
        $update_query = $this->db->update('users', $updated_data);

        if($update_query === TRUE) return true;

        return false;

    }

    public function check_current_password($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            if (password_verify($password, $row->password)) return true;

        }
        return false;
    }

    public function  get_user_info($username)
    {
        if(!isset($username)) return false;
        $this->db->where('username', $username);
        $this->db->select('username, email, fullname, avatar_url');
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            return $row;

        }

        return false;


    }

    public function get_user_status($username)
    {


        if(!isset($username)) return false;

        $this->db->where('username', $username);
        $this->db->select('role');
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            $status = $row->role;
            return (int) $status;

        }
    }

    public function get_username_by_id($id)
    {
        if(!isset($id)) return false;

        $this->db->where('id', $id);
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            $username = $row->username;
            return $username;

        }

    }
    public function get_current_user_id()
    {
        if(!is_logged_in()) return false;
        $username = $this->session->userdata('username');
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            $current_user_id = $row->id;
            return $current_user_id;

        }
        return false;
    }

    public function auth($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows() === 1) {

            $row = $query->row();

            if (password_verify($password, $row->password)) return true;

        }
        return false;
    }

    public function register($email, $username, $password, $fullname)
    {

        $userExist = $this->checkIfUserExist($username, $email);

        if(is_string($userExist)) return $userExist;

        $user_data = [

            'email'    => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'fullname' => $fullname,

        ];

        $query = $this->db->insert('users', $user_data);

        if($query === TRUE) return true;
        return false;
    }

    protected function checkIfUserExist($username, $email)
    {
        $error_message = TRUE;

        $this->db->where('username', $username);
        $query1 = $this->db->get('users');

        if($query1->num_rows() === 1) {

            $error_message = "This login is exist, please choose another one.";
            return $error_message;

        }
        $this->db->where('email', $email);
        $query2 = $this->db->get('users');
        if($query2->num_rows() === 1) {

            $error_message = "This email is exist, please choose another one.";
            return $error_message;

        }

        return $error_message;

    }

    public function username_and_login_exit($username, $email)
    {

        if(!is_logged_in()) return false;

        $current_username = get_current_username();

        $id = null;

        $error_message = TRUE;


        $this->db->where('username', $current_username);
        $this->db->select('id');
        $query1 = $this->db->get('users');

        if($query1->num_rows() === 1) {

            global $id;

            $id = $query1->result();

            $id = $id[0]->id;

        }



        $this->db->where('username', $username);
        $this->db->where('id != ', $id);
        $query2 = $this->db->get('users');

        if($query2->num_rows() === 1) {

            $error_message = "This login is exist, please choose another one.";
            return $error_message;

        }


        $this->db->where('email', $email);
        $this->db->where('id != ', $id);
        $query3 = $this->db->get('users');
        if($query3->num_rows() === 1) {

            $error_message = "This email is exist, please choose another one.";
            return $error_message;

        }


        return $error_message;
    }
}