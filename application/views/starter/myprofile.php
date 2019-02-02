<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 02.02.2019
 * Time: 15:56
 */

if(!is_logged_in()) redirect(BASE_URL);

require_template_part('header' ); ?>

<?php if(!empty($user_info)): ?>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <?php if(uri_string() === "myprofile/edit"): ?>

            <?php echo form_open_multipart('profile/update'); ?>

                <div class="form-group">
                    <label for="avatar">Your avatar </label>
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

            <?php else: ?>

            <h4>Your avatar:</h4>
            <?php if(empty($user_info->avatar_url)): ?>
            <p>You din't upload your avatar yet. You can do it now.</p>
            <?php else: ?>
            <img src="<?php echo $user_info->avatar_url ?>" alt="Avatar of <?php echo $user_info->username ?>">
            <?php endif; ?>
            <h4>Username</h4>
            <p><?php echo $user_info->username ?></p>
            <h4>Full name</h4>
            <p><?php echo $user_info->fullname ?></p>
            <h4>E-mail</h4>
            <p><?php echo $user_info->email ?></p>

            <a href="<?php echo BASE_URL ?>myprofile/edit" class="btn btn-primary">Edit my profile</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; ?>

<?php require_template_part('footer') ?>
