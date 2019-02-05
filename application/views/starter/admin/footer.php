<?php

/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 22:29
 */

if(!is_logged_in() || get_current_status() !== 7){
    redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');


?>

<!-- Sticky Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © CI Guestbook <?php echo date('Y') ?> By <a href="https://ehuseynov.com">huseyn0w</a>.</span>
        </div>
    </div>
</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="flash-alerts">
    <div class="action-ok alert alert-success" role="alert"></div>
    <div class="action-error alert alert-error" role="alert"></div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo asset_url() ?>/admin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo asset_url() ?>/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo asset_url() ?>/admin/vendor/jquery-easing/jquery.easing.min.js"></script>


<!-- Custom scripts for all pages-->
<script src="<?php echo asset_url() ?>/admin/js/sb-admin.min.js"></script>


<script>
    var siteURL = '<?php echo BASE_URL ?>';
    var tokenHash = '<?php echo $data['csrf_hash'] ?>';
</script>
<script src="<?php echo asset_url() ?>/admin/js/admin.js"></script>

</body>

</html>



