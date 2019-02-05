<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 06.02.2019
 * Time: 0:44
 */
if(!is_logged_in() || get_current_status() !== 7){
    redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');


require_template_part('admin/header');

?>


    <body id="page-top">

<?php require_template_part('admin/nav'); ?>

<div id="wrapper">

<?php require_template_part('admin/sidebar') ?>

    <div id="content-wrapper">

    <div class="container-fluid">

        <?php require_template_part('admin/breadcrumbs') ?>


            <div class="row">
                <div class="col-12">


                    <?php

                        $update_success = $this->session->flashdata('UPDATE_SUCCESS');
                        $update_fail = $this->session->flashdata('UPDATE_FAIL');

                    ?>

                    <?php if(!empty($update_success)): ?>
                        <div class="alert alert-success" role="alert"><?php echo $update_success ?></div>
                    <?php elseif(!empty($update_fail)): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $update_fail ?></div>

                    <?php endif; ?>




                <?php

                    echo form_open('admin/settings/update');


                    foreach ($database_values as $item):  ?>

                    <?php foreach ($item as $key => $value):

                         $label = ucwords($key);
                         $label = str_replace("_", " ", $label);


                     ?>
                        <div class="form-group">

                            <?php

                           echo form_error($key, "<div class=\"alert alert-danger\" role=\"alert\">", "</div>");


                            echo form_label($label, $key);

                                $fullname_data = array(
                                    'id'            => $key,
                                    'name'          => $key,
                                    'type'          => 'text',
                                    'placeholder'   => 'Your fullname',
                                    'value'         => $value,
                                    'class'         => 'form-control',
                                );

                                echo form_input($fullname_data);
                            ?>
                        </div>

                    <?php endforeach; endforeach; ?>





                    <div class="form-group">
                        <?php

                        $submit_data = array(
                            'name'          => 'try_to_update',
                            'value'         => 'Update settings',
                            'class'         => 'btn btn-primary'
                        );

                        echo form_submit($submit_data);
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>

    </div>
    <!-- /.container-fluid -->

<?php
require_template_part('admin/footer');
?>