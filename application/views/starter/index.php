<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 18:15
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$auth_error = $this->session->flashdata('LOGIN_FAIL');

$data['auth_error'] = $auth_error;
$data['settings'] = $settings;
$data['pages'] = $pages;


require_template_part('header', $data ); ?>


    <!-- Main Content -->
    <div class="container">
      <div class="row">

<?php  if(empty($reviews)): ?>
    <div class="col-lg-8 col-md-10 mx-auto">
        <h2>No reviews, you can add new one.</h2>
    </div>


<?php else:

    foreach ($reviews as $review):

?>

        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-preview">
            <a href="<?php echo BASE_URL ?>reviews/show/<?php echo $review->id ?>">
              <h2 class="post-title">
                <?php echo $review->header; ?>
              </h2>
              <h3 class="post-subtitle">
                  <?php echo $review->excerpt; ?>
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="<?php echo BASE_URL ?>users/<?php echo $review->author_name; ?>"><?php echo $review->author_name; ?></a>
              on <?php echo $review->created_date; ?>
            </p>
          </div>
        </div>

 <?php endforeach; endif; ?>


      </div>
        <!-- Pager -->
        <div class="clearfix text-center">
            <?php echo $links ?>
        </div>
    </div>

    <hr>

<?php require_template_part('footer', $data) ?>