<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 17:37
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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

    public function show_profile_info($username = null)
    {

        if(is_null($username)) $username = get_current_username();
        $this->load->model('users_model');
        $user_info = $this->users_model->get_user_info($username);

        if(!$user_info) show_404();

        $data['user_info'] = [];
        if(!empty($user_info)){
            $data['user_info'] = $user_info;
        }
        $data['searched_username'] = $username;
        $this->load->view(CURRENT_TEMPLATE.'/myprofile', $data);
    }

    public function index($current_page = 1)
    {
        $this->load->library('pagination');




        $this->load->model('reviews_model');



        $reviews = $this->reviews_model->show_reviews($current_page);


        $config['total_rows'] = $this->reviews_model->get_total_page_count();
        $config['base_url'] = BASE_URL.'more/';
        $config['first_url'] = BASE_URL;
        $config['per_page'] = POSTS_PER_PAGE;
        $config['display_pages'] = FALSE;
        $config['attributes'] = array('class' => 'btn btn-primary custom-pagination');
        $config['next_link'] = "Next Page";
        $config['prev_link'] = "Prev Page";

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();

        $this->load->model('users_model');

        if(!empty($reviews))
        {
            foreach ($reviews as $key => $review){
                $author_id = $reviews[$key]->author_id;
                $reviews[$key]->author_name = $this->users_model->get_username_by_id($author_id);
            }
        }


        $data['reviews'] = $reviews;

        $this->load->view(CURRENT_TEMPLATE.'/index', $data);
    }

    public function admin()
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
}
