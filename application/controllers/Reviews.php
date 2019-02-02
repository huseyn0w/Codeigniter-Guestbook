<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 28.01.2019
 * Time: 1:33
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

    public function show($id)
    {
        $id = (int) $id;

        if(!isset($id) || $id <= 0 ) redirect(BASE_URL);

        $this->load->model('reviews_model');

        $full_review = $this->reviews_model->show($id);

        $author_id = $full_review[0]->author_id;

        $this->load->model('users_model');
        $full_review[0]->author_name = $this->users_model->get_username_by_id($author_id);


        $data['review'] = $full_review[0];

        $this->load->view(CURRENT_TEMPLATE.'/full_review', $data);
    }

    public function add()
    {
        if(!is_logged_in()) redirect(BASE_URL);

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


                $title = filter_var($this->input->post('title'), FILTER_SANITIZE_EMAIL);
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
        $this->load->view(CURRENT_TEMPLATE.'/new_review');
    }

}