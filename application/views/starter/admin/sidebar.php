<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 22:41
 */
if(!is_logged_in()){
    redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">User Options:</h6>
            <a class="dropdown-item" href="login.html">Profile</a>
            <a class="dropdown-item" href="register.html">Change password</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="<?php echo base_url() ?>">Go to Homepage</a>
            <a class="dropdown-item" href="blank.html">General settings</a>
            <a class="dropdown-item" href="blank.html">All guest book items</a>
        </div>
    </li>
</ul>
