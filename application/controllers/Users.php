<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 23:02
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function login()
    {
        $loginCheck = $this->input->post('try_to_login');

        if(isset($loginCheck))
        {

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');


            if ($this->form_validation->run() === TRUE)
            {
                $username = filter_var($this->input->post('username'), FILTER_SANITIZE_STRING);
                $password = $this->input->post('password');
                $this->load->model('users_model');
                $result = $this->users_model->auth($username, $password);
                if($result === TRUE)
                {
                    $authData = [
                        'is_logged' => TRUE,
                        'username'  => $username
                    ];
                    $this->session->set_userdata($authData);
                }
                else{
                    $this->session->set_flashdata('LOGIN_FAIL', 'Wrong credentials, please try again');
                }


            }
            else{
                $this->session->set_flashdata('LOGIN_FAIL', 'Wrong credentials, please try again');
            }


            $this->load->view(CURRENT_TEMPLATE.'/index');

        }

        redirect(BASE_URL);

    }

    public function logout()
    {
        $session_data = array('username', 'is_logged');
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        redirect(BASE_URL);
    }

    public function register()
    {
        $registerButton = $this->input->post('try_to_register');

        if(isset($registerButton))
        {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('fullname', 'Fullname', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|min_length[6]|matches[password]');


            if ($this->form_validation->run() === TRUE)
            {
                $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
                $username = filter_var($this->input->post('username'), FILTER_SANITIZE_STRING);
                $fullname = filter_var($this->input->post('fullname'), FILTER_SANITIZE_STRING);
                $password = $this->input->post('password');
                $this->load->model('users_model');
                $result = $this->users_model->register($email, $username, $password, $fullname);
                if($result === TRUE)
                {
                    $authData = [
                        'is_logged' => TRUE,
                        'username'  => $username
                    ];
                    $this->session->set_userdata($authData);
                    redirect(BASE_URL);
                }
                else{
                    $this->session->set_flashdata('REGISTER_FAIL', $result);
                }


            }

        }

        $this->load->view(CURRENT_TEMPLATE.'/register');
    }
}