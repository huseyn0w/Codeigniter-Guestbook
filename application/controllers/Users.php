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

    public function edit_profile()
    {
        if(!is_logged_in()) redirect(BASE_URL);

        $username = get_current_username();
        $this->load->model('users_model');
        $user_info = $this->users_model->get_user_info($username);
        $data['user_info'] = array();
        if(!empty($user_info)){
            $data['user_info'] = $user_info;
        }
        $this->load->view(CURRENT_TEMPLATE.'/editprofile', $data);
    }

    public function update_profile()
    {


        $update_profile = $this->input->post('save_changes');
        $recaptcha_response = $this->input->post('recaptcha_response');


        if(isset($update_profile) && isset($recaptcha_response))
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('fullname', 'Fullname', 'required');

            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = RECAPTCHA_SECRET_KEY;


            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            if ($this->form_validation->run() === TRUE && $recaptcha->score >= 0.5)
            {
                $username = filter_var($this->input->post('username'), FILTER_SANITIZE_STRING);
                $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
                $fullname = filter_var($this->input->post('fullname'), FILTER_SANITIZE_STRING);
                $password = $this->input->post('password');

                $avatar = $_FILES['avatar']['name'];

                if(empty($avatar)) $avatar = null;

                $this->load->model('users_model');

                $current_username = get_current_username();

                $password_verified = $this->users_model->check_current_password($current_username, $password);

                if($password_verified !== true)
                {
                    $this->session->set_flashdata('PASSWORD_FAIL', 'You entered wrong password');
                    redirect(BASE_URL.'myprofile/edit');
                }

                $username_and_login_exist = $this->users_model->username_and_login_exit($username, $email);


                if($username_and_login_exist !== true)
                {
                    $this->session->set_flashdata('USERNAME_LOGIN_FAIL', $username_and_login_exist);
                    redirect(BASE_URL.'myprofile/edit');
                }

                if(!is_null($avatar))
                {
                    $config['upload_path']          = 'uploads/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 2048;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('avatar'))
                    {
                        $this->session->set_flashdata('AVATAR_ERROR', $this->upload->display_errors());

                        redirect(BASE_URL.'myprofile/edit');

                    }
                    else
                    {
                        $avatar_data = $this->upload->data();

                        $avatar_url = BASE_URL.'uploads/'.$avatar_data['file_name'];

                        $update_user_data = $this->users_model->update_user_data($username, $email, $fullname, $avatar_url);

                        if($update_user_data === TRUE)
                        {
                            $this->session->username = $username;
                            $this->session->email = $email;
                            $this->session->set_flashdata('UPDATE_SUCCESS', 'Your profile data has been successfully updated');
                        }
                        redirect(BASE_URL.'myprofile');

                    }
                }
                else{
                    $update_user_data = $this->users_model->update_user_data($username, $email, $fullname);

                    if($update_user_data === TRUE)
                    {
                        $this->session->username = $username;
                        $this->session->email = $email;
                        $this->session->set_flashdata('UPDATE_SUCCESS', 'Your profile data has been successfully updated');
                    }
                    redirect(BASE_URL.'myprofile');
                }

            }
            else{
                redirect(BASE_URL.'myprofile');
            }
        }
        else{
            redirect(BASE_URL);
        }


    }

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
                    $current_status = $this->users_model->get_user_status($username);

                    $authData = [
                        'is_logged' => TRUE,
                        'username'  => $username,
                        'status'    => $current_status
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
        $recaptcha_response = $this->input->post('recaptcha_response');

        if(isset($registerButton) && isset($recaptcha_response))
        {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('fullname', 'Fullname', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|min_length[6]|matches[password]');

            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = RECAPTCHA_SECRET_KEY;


            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);



            if ($this->form_validation->run() === TRUE && $recaptcha->score >= 0.5)
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
                        'is_logged'   => TRUE,
                        'user_status' => 0,
                        'username'    => $username
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