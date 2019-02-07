<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 28.01.2019
 * Time: 1:33
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

    public function ajax_action($id = null)
    {
        if(!is_logged_in() || !$this->input->is_ajax_request() || $id === null) return false;

        $id = (int) $id;
        $postType = $this->input->post('postType');


        $return_data = [];


        if($id > 0 && $postType === "review")
        {
            $this->load->model('reviews_model');
            $action = $this->input->post('action');
            if($action === "delete"){
                $result = $this->reviews_model->delete_review($id);
            }
            elseif($action === "approve"){
                $result = $this->reviews_model->approve_review($id);
            }
            if($result === TRUE){
                $return_data['code'] = "OK";
                $return_data['message'] = "Done";
            }
            else{
                $return_data['code'] = "OK";
                $return_data['message'] = "PROBLEM";
            }
            echo json_encode($return_data);
        }

        return;
    }


    public function full($id = null)
    {
        if(!is_logged_in() || $id === null) redirect(BASE_URL);
        return $this->show($id);
    }

    public function show($id = null)
    {
        if($id === null) redirect(BASE_URL);

        $id = (int) $id;

        if(!isset($id) || $id <= 0 ) redirect(BASE_URL);

        $this->load->model('settings_model');
        $data['settings'] = $this->settings_model->load_settings();
        $data['pages'] = $this->settings_model->get_pages();

        $this->load->model('reviews_model');

        $full_review = $this->reviews_model->show($id);

        if(empty($full_review)) show_404();

        $author_id = $full_review[0]->author_id;

        $this->load->model('users_model');
        $full_review[0]->author_name = $this->users_model->get_username_by_id($author_id);


        $data['review'] = $full_review[0];

        $this->load->view(CURRENT_TEMPLATE.'/full_review', $data);
    }

    public function add()
    {
        if(!is_logged_in()) redirect(BASE_URL);

        $this->load->model('settings_model');
        $data['settings'] = $this->settings_model->load_settings();
        $data['pages'] = $this->settings_model->get_pages();


        $add_new_review = $this->input->post('add_new_review');
        $recaptcha_response = $this->input->post('recaptcha_response');

        if(isset($add_new_review) && isset($recaptcha_response)){
            $this->form_validation->set_rules('title', 'Review title', 'required');
            $this->form_validation->set_rules('excerpt', 'Review excerpt', 'required');
            $this->form_validation->set_rules('fullreview', 'Full review', 'required');

            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = RECAPTCHA_SECRET_KEY;


            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            if ($this->form_validation->run() === TRUE && $recaptcha->score >= 0.5)
            {
                require_once(getcwd().'\application\libraries\htmlpurifier\HTMLPurifier.auto.php');


                $title = filter_var($this->input->post('title'), FILTER_SANITIZE_STRING);
                $excerpt = filter_var($this->input->post('excerpt'), FILTER_SANITIZE_STRING);

                $full_review = $this->input->post('fullreview');


                $config = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($config);
                $clean_review = $purifier->purify($full_review);


                $this->load->model('users_model');
                $current_user_id = $this->users_model->get_current_user_id();
                $username = get_current_username();
                $current_status = $this->users_model->get_user_status($username);
                $this->load->model('reviews_model');
                $result = $this->reviews_model->add($title, $excerpt, $clean_review, $current_user_id, $current_status);

                if($result === TRUE)
                {
                    redirect(BASE_URL);
                }
                else
                {
                    $this->session->set_flashdata('REVIEW_ADDING_FAIL', $result);
                }


            }
        }
        $this->load->view(CURRENT_TEMPLATE.'/new_review', $data);
    }

}