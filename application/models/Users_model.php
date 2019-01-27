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
}