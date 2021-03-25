<?php $siteDescription = ' Local Inspire - User Reviews and Recommendations of Top Restaurants, Lodging, Things to do, and more at Localinspire'; ?>
<?php $siteDescription = ' Localinspire'; ?>
<!DOCTYPE html5>
<html lang="en">

<head>
    <title>
        <?= $this->fetch('title') ?> <?php echo " | " .  $siteDescription ?>
    </title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Localinspire Reviews & Recommendations">
    <?= $this->Html->meta('description', $this->fetch('title') . ' ' . $siteDescription); ?>
    <meta name="keywords" content="localinspire,recommendations,vacation,vacations,reviews,restaurants,cabins,lodging,trip,travel,local,business,review,vacation,vacations,travel packages,planning,hotel,hotels,motel,bed and breakfast,inn,resorts,popular,plan,airfare,cheap,discount,golf,ski,attractions,advice">

    <meta property="og:title" content="<?= $this->fetch('title') ?>">
    <!-- <meta property="og:image" content="<?= $this->fetch('image') ?>"> -->
    <meta property="og:image" content="<?= $this->fetch('image') ?>" />
    <meta property="og:site_name" content="LocalInspire">
    <meta property="og:description" content="<?= isset($siteDescription) ? $siteDescription : "Join us to enjoy reviews and recommendations of family and friends & inspire local businesses to be great!" ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>">
    <meta property="fb:app_id" content="363493931189519">
    
       <meta name="google-site-verification" content="5nTX3LOiIeJHS9wJcFPUcc5R4v1ym2AqTjf73CYSBlE" />
       
       <!-- GOOGLE ADSENSE -->
       
       <script data-ad-client="ca-pub-5120753627998689" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
       
    <!-- GOOGLE ADSENSE -->
    
    <!-- Favicon -->
    <link rel="icon" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png" sizes="16x16" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap/bootstrap.min.css">
    <!--<link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/css/newcss.css">-->
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/custombox/dist/custombox.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-megamenu/src/sr.megamenu.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/lightpick/lightpick.css">

    <!-- Main CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- for explore css and js -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-bg-video/sr-bg-video.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/dzsparallaxer/dzsparallaxer.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/ion-rangeslider/css/ion.rangeSlider.css">
    <!-- <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap-tagsinput/css/bootstrap-tagsinput.css">


    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/mapbox-gl-js/v0.52.0/mapbox-gl.js"></script>
    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/mapbox-gl-js/v0.52.0/mapbox-gl.css" rel="stylesheet" />
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/mapbox-gl-geocoder/v3.1.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/mapbox-gl-geocoder/v3.1.0/mapbox-gl-geocoder.css" type="text/css" />

    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/fonts/themify-icons-font/themify-icons.css">

    <!-- Material Icons -->
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/fonts/material-icons/css/materialdesignicons.css">

    <!-- Pagination -->
    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); 
                                            ?>
    <!--assets/css/Pagination.css">-->
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/owlcarousel/owl.carousel.css" />
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/owlcarousel/owl.theme.default.css">




    <!-- Bootstrap DatePicker Css -->
    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />


    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap/bootstrap.min.js"></script>
    <!-- Pagination -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/Pagination.js"></script>
    <!-- Moment Plugin Js -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/admin/plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Light Gallery Plugin Css -->
    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/light-gallery/css/lightgallery.css" rel="stylesheet">
    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/light-gallery/css/lg-fb-comment-box.css" rel="stylesheet">

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/notification/ns-default.css" />
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/notification/ns-style-growl.css" />
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/notification/modernizr.custom.js"></script>

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2-bootstrap.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/select2/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/toastr/toastr.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/toastr/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/app/app.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/app/app.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/app/jquery.blockui.min.js"></script>


    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/css/theme.css">


    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/custombox/dist/custombox.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/custombox/dist/custombox.legacy.min.js"></script>

    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-megamenu/src/sr.megamenu.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/svg-injector/dist/svg-injector.min.js"></script>


    <script src="https://connect.facebook.net/en_US/sdk.js?hash=8b91bca3d673d6b4bdf8327a5e16cde5&amp;ua=modern_es6" async="" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <!-- JS Implementing Plugins -->
    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-megamenu/src/sr.megamenu.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/svg-injector/dist/svg-injector.min.js"></script> -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-bg-video/sr-bg-video.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/sr-bg-video/vendor/player.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/custombox/dist/custombox.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/custombox/dist/custombox.legacy.min.js"></script> -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/appear.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/circles/circles.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/momentjs/moment.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/select2/dist/js/select2.min.js"></script>
    <!-- JS LocalNavi -->
    <!--<script src="assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>-->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/sr.core.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.header.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.unfold.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.bg-video.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.malihu-scrollbar.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.focus-state.js"></script>
    <!--  <script src="assets/js/components/sr.datatables.js"></script>-->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.validation.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.modal-window.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.step-form.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.show-animation.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.range-datepicker.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.chart-pie.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.countries.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.progress-bar.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.svg-injector.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.go-to.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.slick-carousel.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.scroll-effect.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.selectpicker.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.range-slider.js"></script>
    <!-- js for explore -->

    <!-- JS Implementing Plugins -->
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.counter.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.sticky-block.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/typed.js/lib/typed.min.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/slick-carousel/slick/slick.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.scroll-nav.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.fancybox.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/lightpick/moment.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/lightpick/lightpick.js"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/readmore/readmore.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback" async defer></script>


    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/datatables/dataTables.bootstrap4.min.css">
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/datatables/datatables.min.js"></script>

    <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/sweetalert2/sweetalert2.min.css" />
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/sweetalert2/sweetalert2.min.js"></script>


    <link rel="stylesheet" href="<?= $this->Url->build('/plugins/jquery-confirm/dist/jquery-confirm.min.css', ['fullBase' => true]); ?>">
    <script src="<?= $this->Url->build('/plugins/jquery-confirm/dist/jquery-confirm.min.js', ['fullBase' => true]); ?>"></script>

    <link href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>


    <?= $this->element('custom_css') ?>
    <?= $this->element('custom_js') ?>
    <?= getEnv('SERVER_NAME') != "inspire4.local" ? $this->element('socket') : "" ?>


</head>
<!-- onload="getLocation()" -->

<body>
    <!-- ========== HEADER ========== -->
    <?php if (strtolower($this->request->getParam('controller')) == "home") : ?>
        <?php //echo $this->element('home_header') 
        ?>
    <?php else : ?>
        <?= $this->element('header') ?>
        <?php if (!empty($currentUser) and strtolower($this->request->getParam('controller')) == "account") : ?>
            <?= $this->element('accountnav') ?>
        <?php endif; ?>
        <?php if (!empty($currentUser) and strtolower($this->request->getParam('controller')) == "biz") : ?>
            <?= $this->element('biznav') ?>
        <?php endif; ?>
        <?php if (!empty($currentUser) and strtolower($this->request->getParam('controller')) == "manager") : ?>
            <?= $this->element('managernav') ?>
        <?php endif; ?>
        <?php if (1 == 2) : ?>

            <div class="container">
                <div class="alert alert-success sentMail col-md-12 mt-0" style="display: none;">
                    <span class="text-dark"><b>Mail has been sent!</b> Check your inbox and spam folders for a confirmation email, or click here to <a href="#" onclick="ResendMail()">resend.</a></span>
                </div>
                <div class="alert alert-warning Verifymail col-md-12 mt-0  mb-0" <?php if (!empty($currentUser) and $currentUser->email_verification_status == false) { ?> style=" display: block;" <?php } elseif (!empty($currentUser) and $currentUser->email_verification_status == true) { ?> style=" display: none;" <?php } else { ?> style=" display: none;" <?php } ?>>
                    <span class="text-dark"><b>Your account is still unconfirmed!</b> Check your inbox and spam folders for a confirmation email, or click here to <a href="#" onclick="ResendMail()">resend.</a></span>
                </div>

                <div class="resetmsg"></div>
            </div>

        <?php endif; ?>


    <?php endif; ?>

    <?= $this->Flash->render() ?>

    <?= $this->fetch('content') ?>

    <?= $this->element('login_modal') ?>


    <?= $this->element('cancel_subscription_modal') ?>
    <?= $this->element('send_message_success_modal') ?>

    <!-- Send Message Modal Window -->
    <?= $this->element('send_message_modal') ?>
    <!-- End Send Message Modal Window -->



    <!-- Report profile Modal Window -->
    <?= $this->element('report_profile_modal') ?>
    <!-- End Report Profile Modal Window -->

    <!-- Report Success Modal Window -->
    <?= $this->element('report_profile_success_modal') ?>


    <!-- End Sidebar Info -->
    <?= $this->element('block_result_modal') ?>
    <?= $this->element('unblock_result_modal') ?>



    <?= $this->element('footer') ?>


    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/custom.js"></script> -->
    <!-- Notification plugin -->
    <script src='<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/notification/classie.js' type="text/javascript"></script>
    <script src='<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/notification/notificationFx.js' type="text/javascript"></script>
    <!-- JS Plugins Init. -->
    <!-- Light Gallery Plugin Js -->
    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/light-gallery/js/lightgallery-all.js"></script> -->
    <?= $this->element('light_gallery') ?>
    <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/light-gallery/js/lg-fullscreen.js"></script>
    <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/light-gallery/js/lg-video.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script type="text/javascript">
        var base_url = "<?= $this->Url->build('/', ['fullBase' => true]); ?>";

        $(document).ready(function() {

        });
    </script>


</body>

</html>