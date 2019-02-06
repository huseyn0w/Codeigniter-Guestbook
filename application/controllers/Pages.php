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
        $this->load->model('settings_model');
        $data['settings'] = $this->settings_model->load_settings();

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
        $this->load->model('settings_model');
        $data['settings'] = $this->settings_model->load_settings();



        $this->load->model('reviews_model');

        $reviews = $this->reviews_model->show_reviews($current_page);

        $this->load->library('pagination');

        $config['total_rows'] = $this->reviews_model->get_total_page_count();
        $config['base_url'] = BASE_URL.'more/';
        $config['first_url'] = BASE_URL;

        if(isset($data['settings'])){
            $config['per_page'] = $data['settings'][1]->value;
        }
        else{
            $config['per_page'] = POSTS_PER_PAGE;
        }


        $config['display_pages'] = FALSE;
        $config['attributes'] = array('class' => 'btn btn-primary custom-pagination');
        $config['next_link'] = "Next Page";
        $config['prev_link'] = "Prev Page";



        $this->load->model('users_model');


        if(!empty($reviews))
        {
            foreach ($reviews as $key => $review){
                $author_id = $reviews[$key]->author_id;
                $reviews[$key]->author_name = $this->users_model->get_username_by_id($author_id);
            }

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
        }


        $data['reviews'] = $reviews;



        $this->load->view(CURRENT_TEMPLATE.'/index', $data);
    }

}
