<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 19:02
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL ?>">Home</a>
                </li>
            <?php if(!is_logged_in()): ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#">Log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Registration</a>
                </li>
            <?php endif; ?>
            <?php if(is_logged_in()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="myprofile">Profile</a>
                </li>
            <?php if(get_current_status() === 7): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Admin panel</a>
                </li>
            <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="reviews/add">Add new review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

