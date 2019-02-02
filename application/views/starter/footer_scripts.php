<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 15:15
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo asset_url() ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo asset_url() ?>/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Custom scripts for this template -->
<script src="<?php echo asset_url() ?>/js/clean-blog.min.js"></script>
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>


<?php if(uri_string() === "register" || uri_string() === 'reviews/add' || uri_string() === 'myprofile/edit'): ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_PUBLIC_KEY ?>"></script>

<script>
    //global variables
    var RECAPTCHA_PUBLIC_KEY = '<?php echo RECAPTCHA_PUBLIC_KEY ?>';
</script>

<?php endif; ?>




<script src="<?php echo asset_url() ?>/js/main.js"></script>

</body>

</html>

