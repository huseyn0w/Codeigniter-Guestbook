<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 28.01.2019
 * Time: 1:33
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function add()
    {
        $this->load->view(CURRENT_TEMPLATE.'/new_post');
    }

}