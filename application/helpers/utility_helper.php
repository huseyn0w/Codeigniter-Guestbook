<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 18:08
 */



defined('BASEPATH') OR exit('No direct script access allowed');

function print_arr($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function asset_url()
{
    return base_url().'/assets/'.CURRENT_TEMPLATE;
}

function require_template_part($filename, $data = null)
{
    require_once(getcwd().'/application/views/'.CURRENT_TEMPLATE.'/'.$filename.'.php');
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

function get_current_username(){
    $username = FALSE;
    if( isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

    }
    if(!empty($username)) return $username;


    return false;
}

function get_current_status(){
    $status = FALSE;
    if( isset($_SESSION['status']))
    {
        $status = $_SESSION['status'];

    }
    if(!empty($status)) return $status;


    return false;
}