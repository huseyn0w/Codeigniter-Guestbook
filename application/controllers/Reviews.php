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
        if(!isset($id)) redirect(BASE_URL);

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
        if(isset($add_new_review)){
            $this->form_validation->set_rules('title', 'Review title', 'required');
            $this->form_validation->set_rules('excerpt', 'Review excerpt', 'required');
            $this->form_validation->set_rules('fullreview', 'Full review', 'required');

            if ($this->form_validation->run() === TRUE)
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
                $current_status = $this->users_model->get_user_status();
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