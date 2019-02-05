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

    public function reviews($prefix = 'more', $posts_start_count = 1)
    {


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