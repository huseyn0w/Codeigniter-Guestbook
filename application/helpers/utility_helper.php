<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 18:08
 */

defined('BASEPATH') OR exit('No direct script access allowed');

function asset_url()
{
    return base_url().'/assets/'.CURRENT_TEMPLATE;
}

function require_template_part($filename, $data = null)
{
    require_once(getcwd().'\application\views\\'.CURRENT_TEMPLATE.'\\'.$filename.'.php');
}

function is_logged_in()
{
    $username = '';
    $logged = FALSE;
    if( isset($_SESSION['username']) && isset($_SESSION['is_logged']))
    {
        $username = $_SESSION['username'];
        $logged = $_SESSION['is_logged'];

    }
    if(!empty($username) && $logged === TRUE) return true;


    return false;
}