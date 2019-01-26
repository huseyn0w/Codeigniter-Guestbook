<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 18:08
 */

function asset_url()
{
    return base_url().'/assets/'.CURRENT_TEMPLATE;
}

function require_template_part($filename)
{
    require_once(getcwd().'\application\views\\'.CURRENT_TEMPLATE.'\\'.$filename.'.php');
}
