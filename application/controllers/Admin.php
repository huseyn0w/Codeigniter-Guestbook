<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 05.02.2019
 * Time: 21:17
 */

class Admin extends CI_Controller{

    public function index()
    {
        if(!is_logged_in()) redirect(BASE_URL);

        $this->load->model('reviews_model');

        $reviews = $this->reviews_model->get_unapproved_reviews();

        $data['count_reviews'] = count($reviews);

        $this->load->model('users_model');

        $data['reviews'] = [];

        if( !empty($reviews) && $reviews !== false)
        {
            foreach($reviews as $review)
            {
                $review->author_username = $this->users_model->get_username_by_id($review->author_id);
            }
            $data['reviews'] = $reviews;
        }

        $data['csrf_token_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();


        $this->load->view(CURRENT_TEMPLATE.'/admin/index', $data);
    }

    public function settings($prefix = null)
    {
        if(!is_logged_in()) redirect(BASE_URL);

        $updateCheck = $this->input->post('try_to_update');

        if($prefix === "update")
        {
            if(isset($updateCheck))
            {

                $this->form_validation->set_rules('github_url', 'Github profile', 'required');
                $this->form_validation->set_rules('posts_per_page', 'Posts per page', 'required|min_length[1]');
                $this->form_validation->set_rules('front_copyright', 'Front Copyright', 'required|min_length[6]');
                $this->form_validation->set_rules('small_headline', 'Small headline', 'required|min_length[6]');


                if ($this->form_validation->run() === TRUE)
                {
                    $front_copyright = $this->input->post('front_copyright');
                    $github_link = filter_var($this->input->post('github_url'), FILTER_SANITIZE_URL);
                    $posts_per_page = filter_var($this->input->post('posts_per_page'), FILTER_SANITIZE_NUMBER_INT);
                    $small_headline = filter_var($this->input->post('small_headline'), FILTER_SANITIZE_STRING);

                    require_once(getcwd().'\application\libraries\htmlpurifier\HTMLPurifier.auto.php');

                    $config = HTMLPurifier_Config::createDefault();
                    $purifier = new HTMLPurifier($config);
                    $front_copyright = $purifier->purify($front_copyright);



                    $update_data = [
                        'github_url'      => $github_link,
                        'posts_per_page'  => $posts_per_page,
                        'small_headline'  => $small_headline,
                        'front_copyright' => $front_copyright
                    ];

                    $this->load->model('settings_model');

                    $result = $this->settings_model->update_settings($update_data);
                    if($result === TRUE)
                    {
                        $this->session->set_flashdata('UPDATE_SUCCESS', "DATA HAS BEEN UPDATED");
                    }
                    else
                    {
                        $this->session->set_flashdata('UPDATE_FAIL', "ERROR");
                    }
                    redirect(BASE_URL.'admin/settings');

                }
            }
            else{
                redirect(BASE_URL.'admin/settings');
            }


        }
        else
        {
            $data['database_values'] = $this->config->item('database_values');

            $this->load->view(CURRENT_TEMPLATE.'/admin/settings', $data);
        }



    }

    public function reviews($prefix = 'more', $posts_start_count = 1)
    {

        if(!is_logged_in()) redirect(BASE_URL);


        $this->load->model('reviews_model');

        $this->load->library('pagination');

        $config['total_rows'] = $this->reviews_model->get_total_page_count();
        $config['base_url'] = BASE_URL.'admin/reviews/more/';
        $config['first_url'] = BASE_URL.'admin/reviews/';
        $config['per_page'] = 10;
        $config['attributes'] = array('class' => 'btn btn-primary custom-admin-pagination');
        $config['next_link'] = "Next Page";
        $config['prev_link'] = "Prev Page";

        $reviews = $this->reviews_model->get_all_reviews($posts_start_count);

        if( !empty($reviews) && $reviews !== false)
        {
            $this->load->model('users_model');
            foreach($reviews as $review)
            {
                $review->author_username = $this->users_model->get_username_by_id($review->author_id);
            }
            $data['reviews'] = $reviews;

            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
        }

        $data['csrf_token_name'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();

        $this->load->view(CURRENT_TEMPLATE.'/admin/reviews', $data);
    }
}