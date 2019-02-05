<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 27.01.2019
 * Time: 22:27
 */


if(!is_logged_in() || get_current_status() !== 7){
    redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Codeigniter GB Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo asset_url() ?>/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?php echo asset_url() ?>/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo asset_url() ?>/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Main styles for this template-->
    <link href="<?php echo asset_url() ?>/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo asset_url() ?>/admin/css/style.css" rel="stylesheet">

</head>
