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
        <div class="col-lg-8 col-md-10 mx-auto text-center">

            <?php
                $update_success = $this->session->flashdata('UPDATE_SUCCESS');

                if(!empty($update_success)): ?>
                <div class="alert alert-success" role="alert"><?php echo $update_success  ?></div>
            <?php endif; ?>


            <div class="profile-group">
                <h4>Your avatar:</h4>
                <?php if(empty($user_info->avatar_url)): ?>
                    <p>You din't upload your avatar yet. You can do it now.</p>
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

            <a href="<?php echo BASE_URL ?>myprofile/edit" class="btn btn-primary">Edit my profile</a>

        </div>
    </div>
</div>

<?php endif; ?>

<?php require_template_part('footer') ?>
