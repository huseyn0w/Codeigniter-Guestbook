<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 01.02.2019
 * Time: 22:44
 */

require_template_part('header') ?>



<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <h2 class="post-title">
                    <?php echo $review->header; ?>
                </h2>
                <div class="review-content">
                    <?php echo $review->full_text ?>
                </div>
                <p class="post-meta">Posted by
                    <a href="<?php echo BASE_URL ?>users/<?php echo $review->author_name; ?>"><?php echo $review->author_name; ?></a>
                    on <?php echo $review->created_date; ?>
                </p>
            </div>
        </div>
    </div>
</div>



<?php require_template_part('footer') ?>
