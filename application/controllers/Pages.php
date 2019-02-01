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

    public function index()
    {

        $this->load->model('reviews_model');
        $reviews = $this->reviews_model->show_all_reviews();
        $this->load->model('users_model');

        if(!empty($reviews))
        {
            foreach ($reviews as $key => $review){
                $author_id = $reviews[$key]->author_id;
                $reviews[$key]->author_name = $this->users_model->get_username_by_id($author_id);

                //$reviews[$key] = (array) $reviews[$key];
            }
        }

        $data['reviews'] = $reviews;




        $this->load->view(CURRENT_TEMPLATE.'/index', $data);
    }

    public function admin()
    {
        $this->load->view(CURRENT_TEMPLATE.'/admin/index');
    }
}
