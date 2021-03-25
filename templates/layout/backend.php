<?php $siteDescription = 'Local Inspire'; ?>
<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Inspire ">
    <title>
        <?= $this->fetch('title') ?> ::
        <?= $siteDescription ?>
    </title>
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <link rel="shortcut icon" type="image/png" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>img/ico/favicon.ico"> -->
    <!-- <link rel="shortcut icon" href="<?= $this->Url->build('/frontend/', ['fullBase' => true]); ?>img/favicon.ico"> -->
    <link rel="shortcut icon" type="image/png" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>fonts/simple-line-icons/style.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>css/app.css">

    <?php echo $this->AssetCompress->css('css'); ?>

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2-bootstrap.min.css">
    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2.min.js"></script> -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/metronicapp/app.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/toastr/toastr.min.css">

    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <?= $this->element('custom_css') ?>
    <!-- END Custom CSS-->


    <?php echo $this->AssetCompress->script('js1'); ?>
    <?php echo $this->AssetCompress->script('js2'); ?>

    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="<?= $this->Url->build('/plugins/jquery-confirm/dist/jquery-confirm.min.css', ['fullBase' => true]); ?>">
    <script src="<?= $this->Url->build('/plugins/jquery-confirm/dist/jquery-confirm.min.js', ['fullBase' => true]); ?>"></script>

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/sweetalert2/sweetalert2.min.css" />
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <?= $this->element('custom_scripts') ?>

</head>

<body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper nav-collapsed menu-collapsed">


        <!-- main menu-->
        <?= $this->element('app_sidebar', ["page" => $page]) ?>
        <!-- / main menu-->


        <!-- Navbar (Header) Starts-->
        <?= $this->element('navbar_header') ?>
        <!-- Navbar (Header) Ends-->

        <div class="main-panel">
            <div class="main-content">
                <div class="content-wrapper">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>

            <footer class="footer footer-static footer-light">
                <p class="clearfix text-muted text-sm-center px-2">
                    <span>Copyright &copy;
                        <?= date("Y") ?>
                        <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Local Inspire</a>, All rights reserved. </span>
                </p>
            </footer>

        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- START Notification Sidebar-->
    <?= $this->element('notification_sidebar') ?>
    <!-- END Notification Sidebar-->
    <!-- Theme customizer Starts-->
    <?php //echo $this->element('theme_customiser')
    ?>
    <!-- Theme customizer Ends-->
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN VENDOR JS-->


    <!-- BEGIN APEX JS-->





    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>js/dashboard1.js" type="text/javascript"></script> -->
    <!-- END PAGE LEVEL JS-->



    <!-- Global site tag (gtag.js) - Google Analytics -->


</body>

</html>