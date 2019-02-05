<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 26.01.2019
 * Time: 18:15
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CI Guestbook</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset_url() ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo asset_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?php echo asset_url() ?>/css/clean-blog.min.css" rel="stylesheet">

    <link href="<?php echo asset_url() ?>/css/style.css" rel="stylesheet">


</head>

<body class="<?php echo uri_string() ?>">


<?php require_template_part('nav') ?>

<?php if(uri_string() !== "register"): ?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php echo asset_url() ?>/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>CI Guestbook</h1>
                    <span class="subheading">Simple guestbook created on Codeigniter framework with love!</span>
                </div>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>

<?php if(!is_logged_in()) require_template_part('login_modal', $data) ?>


