<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 02.02.2019
 * Time: 15:56
 */


$auth_error = $this->session->flashdata('LOGIN_FAIL');

$data['auth_error'] = $auth_error;
$data['settings'] = $settings;
$data['pages'] = $pages;



require_template_part('header', $data ); ?>

<?php if(!empty($user_info)): ?>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto text-center">

            <?php if(is_logged_in()):
                $update_success = $this->session->flashdata('UPDATE_SUCCESS');

                if(!empty($update_success)): ?>
                <div class="alert alert-success" role="alert"><?php echo $update_success  ?></div>
            <?php endif; endif; ?>


            <div class="profile-group">
                <h4>Profile avatar:</h4>
                <?php if(empty($user_info->avatar_url)): ?>
                    <img src="<?php echo asset_url() ?>/img/noavatar.png" class="avatar" alt="No avatar">
                <?php else: ?>
                    <img src="<?php echo $user_info->avatar_url ?>" class="avatar" alt="Avatar of <?php echo $user_info->username ?>">
                <?php endif; ?>
            </div>
            <div class="profile-group">
                <h4>Username</h4>
                <p><?php echo $user_info->username ?></p>
            </div>
            <div class="profile-group">
                <h4>Full name</h4>
                <p><?php echo $user_info->fullname ?></p>
            </div>
            <div class="profile-group">
                <h4>E-mail</h4>
                <p><?php echo $user_info->email ?></p>
            </div>

            <?php if($searched_username === get_current_username()): ?>

                <a href="<?php echo BASE_URL ?>myprofile/edit" class="btn btn-primary">Edit my profile</a>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php endif; ?>

<?php require_template_part('footer', $data) ?>
