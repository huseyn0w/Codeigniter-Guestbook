<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 03.02.2019
 * Time: 15:11
 */

if(!is_logged_in()) redirect(BASE_URL);

$auth_error = $this->session->flashdata('LOGIN_FAIL');

$data['auth_error'] = $auth_error;
$data['settings'] = $settings;
$data['pages'] = $pages;


require_template_part('header', $data ); ?>


    <?php

        $password_error = $this->session->flashdata('PASSWORD_FAIL');
        $login_mail_error = $this->session->flashdata('USERNAME_LOGIN_FAIL');
        $avatar_error = $this->session->flashdata('AVATAR_ERROR');

    ?>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <?php if(!empty($password_error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $password_error  ?></div>
            <?php elseif(!empty($login_mail_error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $login_mail_error  ?></div>
            <?php elseif(!empty($avatar_error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $avatar_error  ?></div>
            <?php endif; ?>

            <?php echo form_open_multipart('myprofile/update'); ?>

            <div class="form-group">
                <label for="avatar">Upload new avatar if you wish</label>
                <br>
                <input type="file" id="avatar" name="avatar" size="20" />
            </div>

            <div class="form-group">

                <label for="username">Username</label>

                <?php echo form_error('username', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>
                <?php

                $username_data = array(
                    'name'          => 'username',
                    'id'            => 'username',
                    'type'          => 'text',
                    'placeholder'   => 'Your username',
                    'value'         => $user_info->username,
                    'required'      => 'required',
                    'class'         => 'form-control',
                    'minlength'     => '3',
                    'maxlength'     => '20'
                );

                echo form_input($username_data);
                ?>
            </div>




            <div class="form-group">

                <label for="fullname">Full Name</label>

                <?php echo form_error('fullname', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

                <?php

                $fullname_data = array(
                    'name'          => 'fullname',
                    'id'            => 'fullname',
                    'type'          => 'text',
                    'placeholder'   => 'Your fullname',
                    'value'         => $user_info->fullname,
                    'class'         => 'form-control',
                    'maxlength'     => '20'
                );

                echo form_input($fullname_data);
                ?>
            </div>

            <div class="form-group">

                <label for="email">Your email</label>

                <?php echo form_error('email', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

                <?php

                $email_data = array(
                    'name'          => 'email',
                    'id'            => 'email',
                    'type'          => 'text',
                    'placeholder'   => 'Your email',
                    'value'         => $user_info->email,
                    'class'         => 'form-control',
                    'maxlength'     => '20'
                );

                echo form_input($email_data);
                ?>
            </div>

            <div class="form-group">

                <label for="password">Enter your current password please in order to save changes</label>

                <?php echo form_error('password', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

                <?php

                $password_data = array(
                    'name'          => 'password',
                    'id'            => 'password',
                    'placeholder'   => 'Your password',
                    'value'         => '',
                    'required'      => 'required',
                    'class'         => 'form-control'
                );

                echo form_password($password_data);
                ?>

            </div>

            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

            <div class="form-group">
                <?php

                $submit_data = array(
                    'name'          => 'save_changes',
                    'value'         => 'Save changes',
                    'class'         => 'btn btn-primary'
                );

                echo form_submit($submit_data);
                echo form_close();
                ?>
            </div>

        </div>
    </div>
</div>



<?php require_template_part('footer', $data) ?>
