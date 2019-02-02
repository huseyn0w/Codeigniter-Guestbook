<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 20:37
 */
defined('BASEPATH') OR exit('No direct script access allowed');
if(is_logged_in()) redirect(BASE_URL);
?>
<?php require_template_part('header') ?>
<section class="auth_cover">
    <div class="container">
        <h2>Registration</h2>
        <?php $register_error = $this->session->flashdata('REGISTER_FAIL'); if(!empty($register_error)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $register_error  ?></div>
        <?php endif;
         echo form_open('register'); ?>

        <div class="form-group">
            <?php echo form_error('email', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>
            <?php

                $email_data = array(
                    'name'          => 'email',
                    'type'          => 'email',
                    'placeholder'   => 'Your email',
                    'value'         => set_value('email'),
                    'required'      => 'required',
                    'class'         => 'form-control',
                    'minlength'     => '3',
                );

                echo form_input($email_data);
            ?>
        </div>
        <div class="form-group">
            <?php echo form_error('username', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>
            <?php

            $username_data = array(
                'name'          => 'username',
                'type'          => 'text',
                'placeholder'   => 'Your username',
                'value'         => set_value('username'),
                'required'      => 'required',
                'class'         => 'form-control',
                'minlength'     => '3',
                'maxlength'     => '20'
            );

            echo form_input($username_data);
            ?>
        </div>

        <div class="form-group">

            <?php echo form_error('password', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

            <?php

            $password_data = array(
                'name'          => 'password',
                'placeholder'   => 'Your password',
                'value'         => '',
                'required'      => 'required',
                'minlength'     => '6',
                'class'         => 'form-control',
                'maxlength'     => '20'
            );

            echo form_password($password_data);
            ?>

        </div>

        <div class="form-group">

            <?php echo form_error('password_confirm', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

            <?php

            $password_confirm_data = array(
                'name'          => 'password_confirm',
                'placeholder'   => 'Confirm password',
                'value'         => '',
                'required'      => 'required',
                'minlength'     => '6',
                'class'         => 'form-control',
                'maxlength'     => '20'
            );

            echo form_password($password_confirm_data);
            ?>

        </div>

        <div class="form-group">

            <?php echo form_error('fullname', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

            <?php

            $fullname_data = array(
                'name'          => 'fullname',
                'type'          => 'text',
                'placeholder'   => 'Your fullname',
                'value'         => set_value('fullname'),
                'class'         => 'form-control',
                'maxlength'     => '20'
            );

            echo form_input($fullname_data);
            ?>
        </div>

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

        <div class="form-group">
            <?php

                $submit_data = array(
                    'name'          => 'try_to_register',
                    'value'         => 'Register',
                    'class'         => 'btn btn-primary'
                );

                echo form_submit($submit_data);
                echo form_close();
            ?>
        </div>

    </div>
</section>

<?php require_template_part('footer_scripts') ?>