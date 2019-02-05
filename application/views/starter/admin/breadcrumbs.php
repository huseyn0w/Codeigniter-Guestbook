<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 05.02.2019
 * Time: 21:53
 */

if(!is_logged_in() || get_current_status() !== 7){
    redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');


?>


<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
</ol>
