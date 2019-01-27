<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 22:14
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php

                    echo validation_errors("<div class=\"alert alert-danger\" role=\"alert\">", "</div>");
                    if(!empty($data)): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $data ?></div>
                    <?php endif;
                    echo form_open('users/login'); ?>
                        <div class="form-group">
                            <?php

                                $username_data = array(
                                        'name'          => 'username',
                                        'id'            => 'username',
                                        'type'          => 'text',
                                        'placeholder'   => 'Your username',
                                        'value'         => '',
                                        'required'      => 'required',
                                        'class'         => 'form-control',
                                        'minlength'     => '3',
                                        'maxlength'     => '20'
                                );

                                echo form_input($username_data);
                            ?>
                        </div>
                        <div class="form-group">

                            <?php

                            $password_data = array(
                                'name'          => 'password',
                                'id'            => 'pass',
                                'placeholder'   => 'Your password',
                                'value'         => '',
                                'required'      => 'required',
                                'class'         => 'form-control',
                                'maxlength'     => '20'
                            );

                            echo form_password($password_data);
                            ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <?php

                    $submit_data = array(
                        'name'          => 'try_to_login',
                        'value'         => 'Log in',
                        'class'         => 'btn btn-primary'
                    );

                    echo form_submit($submit_data);
                    echo form_close();
                ?>
                <a href="/forgot" type="button" class="btn btn-secondary">Forgot password?</a>
            </div>
        </div>
    </div>
</div>
