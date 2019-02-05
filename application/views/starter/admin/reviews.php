<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 05.02.2019
 * Time: 21:22
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


                <?php if(!empty($reviews)): ?>
                    <!-- DataTables Example -->
                    <div class="new-reviews card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            All reviews list</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="reviews-table table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created Date</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($reviews as $review): ?>
                                        <tr>
                                            <td><?php echo $review->header ?></td>
                                            <td><?php echo $review->created_date ?></td>
                                            <td><a href="<?php echo BASE_URL ?>users/<?php echo $review->author_username ?>" target="_blank"><?php echo $review->author_username ?></a></td>
                                            <td>
                                                <a href="<?php echo BASE_URL ?>full/<?php echo $review->id ?>" target="_blank" class="btn btn-primary">See full post</a>
                                                <button type="button" data-deleteID="<?php echo $review->id ?>" class="delete-review btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $pagination_links; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated now.</div>
                    </div>
                <?php endif; ?>

        </div>
        <!-- /.container-fluid -->

        <?php

        $data['csrf_token_name'] = $csrf_token_name;
        $data['csrf_hash'] = $csrf_hash;

        require_template_part('admin/footer', $data);
        ?>
