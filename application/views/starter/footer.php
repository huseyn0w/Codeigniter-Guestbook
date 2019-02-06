<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 19:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if(isset($data)): ?>
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="<?php echo $data['settings'][0]->value ?>">
                          <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                          </span>
                        </a>
                    </li>
                </ul>
                <?php echo $data['settings'][3]->value ?>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php require_template_part('footer_scripts') ?>
