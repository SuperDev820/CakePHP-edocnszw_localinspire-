
<?php 
if(empty($blockme_res)){ /// chek block me condtion webexpert
?>

<!-- Content Section -->
<div class="bg-light">
    <div class="container space-top-1">
        <div class="row">
            <div class="col-lg-3 mb-7 mb-lg-0 profilesidebar">
                <?php
                $this->load->view('includes/profilesidebar');
                ?>
            </div>
            <div class="col-lg-6">

                <!-- Review Details -->
                <div class="reviews">
                </div>
                <!-- End Review Details -->
                <div class="text-center mb-4">
                    <a class="btn btn-soft-primary mt-4 show_more" href="javascript:get_reviews()">Show More <i class="fas ml-2 fa-chevron-down"></i></a>
                </div>
            </div>



            <?php
            $this->load->view('includes/rightprofilesidebar');
            ?>

        </div>
    </div>
</div>
<!-- End Content Section -->
<!-- Report Review Modal Window -->
<div id="reportreviewModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0">Report a problem</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">
            <form id="reportreviewform" class="js-validate" action="<?=base_url()?>v/reportreview" method="POST">
                <div class="p-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate reviews.

                    <div class="bold mt-2">Why do you want to report this review? </div>
                    <!-- Delivery -->
                    <div class="custom-control custom-radio d-flex align-items-center mt-1">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio7" value = "Review contains false information" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio7">
                            <span class="d-block text-dark mt-1 ml-2">Review contains false information</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio8" value = "Review violates guidelines" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio8">
                            <span class="d-block text-dark mt-1 ml-2">Review violates guidelines</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio3" value = "Contains threats, lewdness, or hate speach" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio3">
                            <span class="d-block text-dark mt-1 ml-2">Contains threats, lewdness, or hate speach</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio4" value = "Review posted to wrong location" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio4">
                            <span class="d-block text-dark mt-1 ml-2">Review posted to wrong location</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio5" value = "Review is spam" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio5">
                            <span class="d-block text-dark mt-1 ml-2">Review is spam</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio6" value = "I want to report something else" name="why_do">
                        <label class="custom-control-label ml-1" for="deliveryRadio6">
                            <span class="d-block text-dark mt-1 ml-2">I want to report something else</span>
                        </label>
                    </div>


                </div>

                <!-- Input -->
                <div class="form-group pl-4 pr-4 mb-4 bold small">
                    <label for="exampleSelect1">Please provide specific details below: </label>
                    <!-- Input -->
                    <div class="js-form-message">
                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="specific_details" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="rwid" value="">
                <input type="hidden" name="uid" value="">
                <input type="hidden" name="bid" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>
<!-- End Report Review Modal Window -->
<!-- Report Success Modal Window -->
<div id="succesmodal" class="js-modal-window u-modal-window" style="width: 620px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0">Report submitted successfully</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">

            <!-- Process Section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-12 mb-md-0">
                        <!-- Process -->
                        <div class="text-center">
                            <div class="position-relative">
                                <div id="SVGcircleProcess3" class="svg-preloader min-height-155 mb-2">
                                    <!-- Icon -->
                                    <span class="text-primary btn btn-lg btn-icon mt-7">
                                        <span class="fab fa-whmcs font-size-6 btn-icon__inner btn-icon__inner-bottom-minus"></span>
                                    </span>
                                    <!-- End Icon -->

                                    <!-- SVG Shape -->
                                    <figure class="w-100 position-absolute top-0 right-0 left-0 z-index-n1">
                                        <img class="js-svg-injector" src="../assets/svg/components/circle-process-3.svg" alt="Image Description"
                                             data-parent="#SVGcircleProcess3">
                                    </figure>
                                    <!-- End SVG Shape -->
                                </div>

                                <h2 class="h4 font-weight-semi-bold text-primary">Thank you!</h2>
                                <p class="mb-10">We have received your report and a moderator will investigate it.</p>
                            </div>
                            <!-- End Process -->
                        </div>




                    </div>
                    <!-- End Process Section -->


                </div>
            </div>
            <!-- End Report Success Modal Window -->
        </div></div>
</div>


<!-- Share Review Modal Window -->
<div id="sharereviewModal" class="js-modal-window u-modal-window" style="width: 475px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 mb-0 bold">Share review</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">
            <div class="text-center pr-3 pl-3">

                <a data-js="facebook-share" href="" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="facebookshare">
                    <button type="button" class="btn btn-soft-facebookreg mb-1 mr-2"><i class="fab fa-facebook-f mr-2"></i> Share on Facebook</button>
                </a>
                <a href="" target="_blank" class="twittershare" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                    <button type="button" class="btn btn-soft-twitterreg mb-1"><i class="fab fa-twitter mr-2"></i> Share on Twitter</button>
                </a>
            </div>

            <!-- End Progress Step Form -->

            <!-- Clipboard Input -->
            <form>
                <div class="js-focus-state p-4 mb-2">
                    <div class="input-group  input-group-sm">
                        <input id="referralLink" type="text" class="form-control" value="<?=base_url()?><?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="input-group-append">
                            <a class="js-clipboard input-group-text" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copy Url" onclick="$('input[id=referralLink]').select();document.execCommand('copy');" href="javascript:;" data-content-target="#referralLink" data-class-change-target="#linkIcon" data-default-class="fas fa-clone" data-success-class="fas fa-check">
                                <span id="linkIcon" class="fas fa-clone"></span>
                            </a>
                        </div>
                    </div>
                    <small class="form-text text-center text-graylt">Want to link to it instead? Copy the above URL!</small>
                </div>
            </form>

            <!-- End Clipboard Input -->

           

            <input type="hidden" name="rwid" value="">
            <input type="hidden" name="uid" value="">
            <input type="hidden" name="bid" value="">
            
        </div>
    </div>
</div>
<!-- End Share Review Modal Window -->

<!-- Report Owner Modal Window -->
<div id="reportownerModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0"><i class="fas fa-flag mr-1"></i> Report a problem</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">
            <form id="reportownerform" class="js-validate" method="POST" action="<?=base_url()?>v/reportowner" >
                <div class="p-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate owner reply.
                </div>
                <!-- Input -->
                <div class="form-group pl-4 pr-4 mb-4 small">
                    <label for="exampleSelect1">Please provide specific details below: </label>
                    <!-- Input -->
                    <div class="js-form-message">
                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="reportowner_desc" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="rwid" value="">
                <input type="hidden" name="uid" value="">
                <input type="hidden" name="bid" value="">
                <input type="hidden" name="ownerid" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button type="submit" class="btn btn-smsq bold btn-primary mr-1" data-next-step="#paymentDetailsStep">Submit</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>
<!-- End Report Owner Modal Window -->
<!-- Report Photos Modal Window -->
<div id="reportphotoModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0">Report a problem</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">
            <form id="reportphotoform" class="js-validate" action="<?=base_url()?>v/reportphoto" method="POST">
                <div class="p-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate photos.

                    <div class="bold mt-2">Why do you want to report this photo? </div>
                    <!-- Delivery -->
                    <div class="custom-control custom-radio d-flex align-items-center mt-1">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio1" value = "It's inappropriate, sexually explicit or contains violent imagery" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio1">
                            <span class="d-block text-dark mt-1 ml-2">It's inappropriate, sexually explicit or contains violent imagery</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio2" value = "Low quality" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio2">
                            <span class="d-block text-dark mt-1 ml-2">Low quality</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio3" value = "Duplicate" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio3">
                            <span class="d-block text-dark mt-1 ml-2">Duplicate</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio4" value = "It's posted to the wrong business" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio4">
                            <span class="d-block text-dark mt-1 ml-2">It's posted to the wrong business</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio5" value = "It's a violation of copyright" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio5">
                            <span class="d-block text-dark mt-1 ml-2">It's a violation of copyright</span>
                        </label>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio6" value = "I want to report something else" name="why_do">
                        <label class="custom-control-label ml-1" for="photoreportRadio6">
                            <span class="d-block text-dark mt-1 ml-2">I want to report something else</span>
                        </label>
                    </div>
                </div>

                <!-- Input -->
                <div class="form-group pl-4 pr-4 mb-4 bold small">
                    <label for="exampleSelect1">Please provide specific details below: </label>
                    <!-- Input -->
                    <div class="js-form-message">
                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="specific_details" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="bid" value="">
                <input type="hidden" name="uid" value="">
                <input type="hidden" name="bphotoid" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>
<!-- End Report Photos Modal Window -->

</main>
<?php } /// chek block me condtion webexpert end
else{
    echo ' <div class="bg-light">
           <div class="container space-top-1"> 
               <div class="row bold"  ><p style="color:red !important; text-align:center !important; width:100%; margin: 60px;"> This users profile is not available. </p></div>
           </div>
           </div>
     ';
}
?>
<script>
    function currentSlide(slide, index){
        // console.log("test");
        $('#slide' + slide + ' .review-image-gallery-item').css('display', 'none');
        $('#slide' + slide + ' .slideitem' + index).css('display', 'block');
        $('#sliderdot' + slide + ' .dot').removeClass('active');
        $('#sliderdot' + slide + ' .dotitem' + index).addClass('active');

    }
    var page = 1;
    var $methods = $('.reviews');
    function get_reviews(){
        $.ajax({
            type: "post",
            url: "<?=base_url()?>" + 'profile/get_ajax_user_activity',
            data:{
                page: page,
                uid: "<?=$uid?>"
            },
            success: function(data){
                console.log(data);
                // $('.reviews').html(data);

                $('.reviews').append(data);
                $.SRCore.components.SRUnfold.init($('.reviews [data-unfold-target]'));
                // $('.reviews').data('lightGallery').destroy(true);
                page++;
                // $methods.lightGallery({
                //     thumbnail: true,
                //     selector: 'a.gallery',
                //     appendSubHtmlTo: '.md-item',
                //     addClass: 'fb-comments',
                //     mode: 'lg-fade',
                //     download: false,
                //     enableDrag: false,
                //     enableSwipe: false,
                //     mousewheel: false,
                //     zoom: false,
                //     galleryId: 1
                // });
                // $methods.on('onAfterSlide.lg', function (event, prevIndex, index) {
                //     if (!$('.lg-outer .lg-item').eq(index).attr('data-fb')) {
                //         try {
                //             $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                //             FB.XFBML.parse();
                //         } catch (err) {
                //             $(window).on('fbAsyncInit', function () {
                //                 $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                //                 FB.XFBML.parse();
                //             });
                //         }
                //     }
                // });

            },
            error: function(){
                console.log(error);
            }
        });
    }
    $(document).ready(function(){
        var succss_modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#succesmodal'
            }
        });
        // $methods.lightGallery({
        //     thumbnail: true,
        //     selector: 'a.gallery',
        //     appendSubHtmlTo: '.md-item',
        //     addClass: 'fb-comments',
        //     mode: 'lg-fade',
        //     download: false,
        //     enableDrag: false,
        //     enableSwipe: false,
        //     mousewheel: false,
        //     zoom: false,
        //     galleryId: 1
        // });
        // $methods.on('onAfterSlide.lg', function (event, prevIndex, index) {
        //     if (!$('.lg-outer .lg-item').eq(index).attr('data-fb')) {
        //         try {
        //             $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
        //             FB.XFBML.parse();
        //         } catch (err) {
        //             $(window).on('fbAsyncInit', function () {
        //                 $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
        //                 FB.XFBML.parse();
        //             });
        //         }
        //     }
        // });

        get_reviews();
        $('[data-toggle="tooltip"]').tooltip();

        $('#reportreviewform').submit(function (e) {
            e.preventDefault();
            if(!$(this).valid()) return false;
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: data,
                success: function(data){
                    console.log(data);
                    $('#reportreviewform input[name=rwid]').val("");
                    $('#reportreviewform input[name=uid]').val("");
                    $('#reportreviewform input[name=bid]').val("");
                    $('#reportreviewform textarea').val("");
                    Custombox.modal.close();
                    succss_modal.open();
                },
                error: function(error){
                    console.log(error);
                }
            })
        });


        $('#reportownerform').submit(function (e) {
            e.preventDefault();

            if(!$(this).valid()) return false;
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: data,
                success: function(data){
                    console.log(data);
                    $('#reportownerform input[name=rwid]').val("");
                    $('#reportownerform input[name=uid]').val("");
                    $('#reportownerform input[name=bid]').val("");
                    $('#reportownerform input[name=ownerid]').val("");
                    $('#reportownerform textarea').val("");
                    Custombox.modal.close();
                    succss_modal.open();
                },
                error: function(error){
                    console.log(error);
                }
            })
        });

        $('.reviews').on('click', '.give_helpful', function () {
            var $this = $(this);
            var bid = $(this).data('bid');
            var rwid = $(this).data('rwid');
            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "v/give_helpful",
                    data: {
                        uid: $('input[id=sessionid]').val(),
                        bid: bid,
                        rwid: rwid
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (!data.error) {
                            if (data.count == 1) {
                                var count_text = "1 person found this helpful.";
                            } else {
                                var count_text = data.count + " people found this helpful.";
                            }
                            $('#helpfulcount' + rwid).text(count_text);
                            $($this).removeClass("text-dark");
                            $($this).addClass("text-primary");
                            $($this).removeClass('give_helpful');
                            $($this).addClass('ungive_helpful');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }
        });

        $('.reviews').on('click', '.ungive_helpful', function () {
            var $this = $(this);
            var bid = $(this).data('bid');
            var rwid = $(this).data('rwid');
            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "v/ungive_helpful",
                    data: {
                        uid: $('input[id=sessionid]').val(),
                        bid: bid,
                        rwid: rwid
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (!data.error) {
                            if (data.count == 1) {
                                var count_text = "1 person found this helpful.";
                            } else if (data.count == 0) {
                                var count_text = "";
                            } else {
                                var count_text = data.count + " people found this helpful.";
                            }
                            $('#helpfulcount' + rwid).text(count_text);
                            $($this).addClass("text-dark");
                            $($this).removeClass("text-primary");
                            $($this).removeClass('ungive_helpful');
                            $($this).addClass('give_helpful');

                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }
        });

        $('body').on('click', '.photo_report', function(){
            console.log($(this).data('bid'));
            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                var uid = $('input[id=sessionid]').val();
                var phid = $(this).data('phid');
                var bid = $(this).data('bid');
                console.log(bid);
                $('#reportphotoModal input[name=bphotoid]').val(phid);
                $('#reportphotoModal input[name=uid]').val(uid);
                $('#reportphotoModal input[name=bid]').val(bid);

                new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '#reportphotoModal'
                    }
                }).open()
            }

        });

        $('body').on('click', '.photo_helpful', function(){
            var $this = $(this);
            var bid = $(this).data('bid');
            var bphotoid = $(this).data('phid');
            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "v/give_photo_helpful",
                    data: {
                        uid: $('input[id=sessionid]').val(),
                        bid: bid,
                        bphotoid: bphotoid
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (!data.error) {
                            // console.log(data);
                            $this.find('.tooltiptext').text(data.count);
                            $this.find('.tooltiptext').css('display', 'inline');
                            $('body .gallery_item_' + bphotoid).attr('data-helfulc', data.count);

                            if (data.count == 1) {
                                var count_text = "1 person found this helpful.";
                            } else if (data.count == 0) {
                                var count_text = "";
                            } else {
                                var count_text = data.count + " people found this helpful.";
                            }
                            $('#helpfulcount' + bphotoid).text(count_text);
                            $($this).addClass("gave_photo_helpful");
                            // $($this).removeClass("photo_helpful");

                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }

        });

        $('#reportphotoform').submit(function (e) {
            e.preventDefault();

            if(!$(this).valid()) return false;
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: data,
                success: function(data){
                    console.log(data);
                    var phid = $('#reportphotoform input[name=photoid]').val();
                    $('#reportphotoform input[name=bid]').val("");
                    $('#reportphotoform input[name=uid]').val("");
                    $('#reportphotoform input[name=photoid]').val("");
                    $('#reportphotoform textarea').val("");
                    $('body .photo_report').find('[data-phid="'+phid+'"]').removeClass('photo_report');
                    Custombox.modal.close();
                    succss_modal.open();
                },
                error: function(error){
                    console.log(error);
                }
            })
        });























        $('body').on('click', '.reportreview', function(){

            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                var uid = $('input[id=sessionid]').val();
                var rwid = $(this).data('rw');
                var bid = $(this).data('b');
                console.log(bid);
                $('#reportreviewform input[name=rwid]').val(rwid);
                $('#reportreviewform input[name=uid]').val(uid);
                $('#reportreviewform input[name=bid]').val(bid);

                new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '#reportreviewModal'
                    }
                }).open()

            }
        });

        $('body').on('click', '.sharereview', function(){

            // if($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == ""){
            // 	$('.loginn').trigger('click');
            // }else{
            var uid = $('input[id=sessionid]').val();
            var rwid = $(this).data('rw');
            var bid = $(this).data('b');
            var url = $(this).data('url');
            console.log(url);
            $('#sharereviewModal input[name=rwid]').val(rwid);
            $('#sharereviewModal input[name=uid]').val(uid);
            $('#sharereviewModal input[name=bid]').val(bid);
            $('#sharereviewModal input[id=referralLink]').val(url);
            $('#sharereviewModal .facebookshare').attr('href', 'https://www.facebook.com/sharer/sharer.php?u='+url);
            $('#sharereviewModal .twittershare').attr('href', 'https://twitter.com/share?url='+url+'&text=Check out this review on @localinspirecom');

            new Custombox.modal({
                content: {
                    effect: 'fadein',
                    target: '#sharereviewModal'
                }
            }).open()

            // }
        });

        $('body').on('click', '.reportownerModal', function(){

            if ($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == "") {
                $('.loginn').trigger('click');
            } else {
                var uid = $('input[id=sessionid]').val();
                var rwid = $(this).data('rw');
                var bid = $(this).data('b');
                var owner = $(this).data('owner');
                console.log(bid);
                $('#reportownerform input[name=rwid]').val(rwid);
                $('#reportownerform input[name=uid]').val(uid);
                $('#reportownerform input[name=bid]').val(bid);
                $('#reportownerform input[name=ownerid]').val(owner);

                new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '#reportownerModal'
                    }
                }).open()

            }
        });

        $('#reportownerform').submit(function (e) {
            e.preventDefault();

            if(!$(this).valid()) return false;
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: data,
                success: function(data){
                    console.log(data);
                    $('#reportownerform input[name=rwid]').val("");
                    $('#reportownerform input[name=uid]').val("");
                    $('#reportownerform input[name=bid]').val("");
                    $('#reportownerform input[name=ownerid]').val("");
                    $('#reportownerform textarea').val("");
                    Custombox.modal.close();
                    succss_modal.open();
                },
                error: function(error){
                    console.log(error);
                }
            })
        });

    });
</script>

</body>

</html>