<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 20:37
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php require_template_part('header') ?>
<div class="container">
    <form name="regForm" class="form-signin" id="form-check" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Please register</h1>
        <?php if (isset($_SESSION['error'])) : ?>
            <?php
            foreach ($_SESSION['error'] as $key => $value): ?>
                <div class="alert alert-danger" role="alert"><?php echo $value  ?></div>
            <?php
            endforeach;
            unset($_SESSION['error']);
        endif;
        ?>
        <div class="form-group">
            <input type="email" autocomplete="off"  required name="email" class="form-control register-input input-ajax" placeholder="E-mail">
            <span class="check-up"></span>
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="text" autocomplete="off" required name="login" class="form-control register-input input-ajax" placeholder="Login">
            <span class="check-up"></span>
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="password" required name="password" class="form-control register-input" placeholder="Password">
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="password" required name="password_confirm" class="form-control register-input" placeholder="Password Confirmation">
            <div class="alert ajax-result" role="alert"></div>
        </div>
        <div class="form-group">
            <input type="text" autocomplete="off" required name="name" class="form-control register-input" placeholder="Name">
        </div>
        <button class="btn btn-lg btn-primary btn-block sendForm" type="submit" name="register_me" disabled>Register</button>
    </form>
</div>
