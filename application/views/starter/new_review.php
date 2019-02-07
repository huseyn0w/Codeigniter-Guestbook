<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 28.01.2019
 * Time: 1:42
 */

$auth_error = $this->session->flashdata('LOGIN_FAIL');

$data['auth_error'] = $auth_error;
$data['settings'] = $settings;
$data['pages'] = $pages;


require_template_part('header', $data ); ?>


    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <h3>Adding new review</h3>

                <?php $review_error = $this->session->flashdata('REVIEW_ADDING_FAIL'); if(!empty($review_error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $review_error  ?></div>
                <?php endif; ?>

                <?php echo form_open('reviews/add'); ?>


                <div class="form-group">
                    <?php echo form_error('title', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>
                    <?php

                    $title_data = array(
                        'name'          => 'title',
                        'type'          => 'text',
                        'placeholder'   => 'Review title',
                        'value'         => set_value('title'),
                        'required'      => 'required',
                        'class'         => 'form-control',
                        'minlength'     => '3',
                    );

                    echo form_input($title_data);
                    ?>
                </div>


                <div class="form-group">

                    <?php echo form_error('excerpt', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

                    <?php

                    $excerpt_data = array(
                        'name'          => 'excerpt',
                        'placeholder'   => 'Review excerpt',
                        'value'         => '',
                        'required'      => 'required',
                        'minlength'     => '6',
                        'class'         => 'form-control',
                        'maxlength'     => '20'
                    );

                    echo form_input($excerpt_data);
                    ?>

                </div>

                <div class="form-group">

                    <?php echo form_error('fullreview', "<div class=\"alert alert-danger\" role=\"alert\">", "</div>"); ?>

                    <?php

                    $fullreview_data = array(
                        'name'          => 'fullreview',
                        'id'            => 'editor-container',
                        'type'          => 'text',
                        'placeholder'   => 'Full Review',
                        'value'         => set_value('fullreview'),
                        'class'         => 'form-control',
                        'maxlength'     => '20'
                    );

                    echo form_textarea($fullreview_data);
                    ?>
                </div>

                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <div class="form-group">
                    <?php

                    $submit_data = array(
                        'name'          => 'add_new_review',
                        'value'         => 'Add new review',
                        'class'         => 'btn btn-primary'
                    );

                    echo form_submit($submit_data);
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <hr>

<?php require_template_part('footer', $data) ?>