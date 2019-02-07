<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 19:02
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>"><?php echo $data['settings'][2]->value ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($data['pages']) && !empty($data['pages'])):

                        //echo uri_string();
                            foreach ($data['pages'] as $page):
                                $active = '';
                                //echo $page->url;
                                if(uri_string() === $page->url ) $active = 'active';
                        ?>
                        <li class="nav-item my-item <?php echo $active ?>">
                            <a class="nav-link"  href="<?php echo BASE_URL.$page->url ?>"><?php echo $page->title ?></a>
                        </li>

                    <?php endforeach; endif;

                    if(!is_logged_in()):?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#">Log in</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL?>register">Register</a>
                        </li>
                    <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

