<!-- Recommend Form Modal Window -->
<!-- Header -->
<header class="card-header ">
    <?php if ($recommend) : ?>
        <?php if ($positive_recommendation) : ?>
            <!-- Testimonials -->
            <div class="js-slide">
                <!-- SVG Quote -->
                <figure class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                        <path class="fill-primary" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
                                            C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
                                            c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
                                            C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
                    </svg>
                </figure>
                <!-- End SVG Quote -->

                <!-- Text -->
                <blockquote class="h6 font-weight-normal text-lh-md mb-4">
                    <h3 class="h6 mb-0 "> <b>Thank you for recommending us...</b> Please give your
                        personal experience with us below!</h3>
                </blockquote>
                <!-- End Text -->

                <!-- Author -->
                <div class="media">
                    <div class="u-avatar mr-3">
                        <img class="img-fluid rounded-circle" src="<?= !empty($business->user) ?  $this->Custom->getDp($business->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="height: 100%;">
                    </div>
                    <div class="media-body">
                        <h4 class="h6 mb-0">
                            <?= !empty($business->user) ?  $business->user->name_desc : '' ?></h4>
                        <span class="d-block txt-14 text-dark">— <?= $business->city->name . ", " . strtoupper($business->city->state->code) ?></span>
                    </div>
                </div>
                <!-- End Author -->
            </div>
            <!-- End Testimonials -->
        <?php else : ?>
            <!-- Testimonials -->
            <div class="js-slide">
                <!-- SVG Quote -->
                <figure class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                        <path class="fill-primary" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
                                            C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
                                            c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
                                            C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
                    </svg>
                </figure>
                <!-- End SVG Quote -->

                <!-- Text -->
                <blockquote class="h6 font-weight-normal text-lh-md mb-4">
                    <h3 class="h6 mb-0 "> <b>Sorry you were disappointed...</b> Please help us to
                        improve by giving us constructive criticism!</h3>
                </blockquote>
                <!-- End Text -->

                <!-- Author -->
                <div class="media">
                    <div class="u-avatar mr-3">
                        <img class="img-fluid rounded-circle" src="<?= !empty($business->user) ?  $this->Custom->getDp($business->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                    </div>
                    <div class="media-body">
                        <h4 class="h6 mb-0">
                            <?= !empty($business->user) ? $business->user->name_desc : '' ?></h4>
                        <span class="d-block txt-14 text-dark">— <?= $business->city->name . ", " . strtoupper($business->city->state->code) ?></span>
                    </div>
                </div>
                <!-- End Author -->
            </div>
            <!-- End Testimonials -->
        <?php endif; ?>
    <?php else : ?>
        <div class="h5">
            Would you recommend <b><?= ucfirst($business->name) ?></b>? &nbsp;&nbsp;

            <?php if (strtolower($this->getRequest()->getParam('action')) == "editreview") { ?>
                <a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => "editReview", \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id, '?' => ['recommend' => 'yes']]); ?>"><button type="button" style="width: 80px;" class="btn btn-primary bold btn-xs">Yes</button></a>
                <a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => "editReview", \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id, '?' => ['recommend' => 'no']]); ?>"><button type="button" style="width: 80px;" class="btn btn-secondary bold btn-xs">No</button></span></a>
            <?php } else { ?>
                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => "addReview", \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'yes']]); ?>"><button type="button" style="width: 80px;" class="btn btn-primary bold btn-xs">Yes</button></a>
                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => "addReview", \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'no']]); ?>"><button type="button" style="width: 80px;" class="btn btn-secondary bold btn-xs">No</button></span></a>
            <?php } ?>

        </div>
    <?php endif; ?>

</header>
<!-- End Header -->

<!-- Body -->
<div class="card-body pt-3">
    <!-- <div class="col-xs-5 mt-2 bold small">Your overall rating of us</div> -->

    <!-- Hire Us Form -->
    <form class="js-validate  mt-3" id="review_form" action="" method="POST" enctype="multipart/form-data">

        <div class="row no-gutters">
            <div class="col-xs-5 clearfix mb-3">
                <fieldset class="rating" style="position:relative">
                    <input type="radio" id="star5" name="star_rating" value="5" <?= $this->Custom->checkRatingRadio($review, 5) ?> /><label data-toggle="tooltip" data-placement="top" title="Excellent" for="star5" title="Excellent"></label>
                    <input type="radio" id="star4" name="star_rating" value="4" <?= $this->Custom->checkRatingRadio($review, 4) ?> /><label data-toggle="tooltip" data-placement="top" title="Very Good" for="star4" title="Very Good"></label>
                    <input type="radio" id="star3" name="star_rating" value="3" <?= $this->Custom->checkRatingRadio($review, 3) ?> /><label data-toggle="tooltip" data-placement="top" title="Average" for="star3" title="Average"></label>
                    <input type="radio" id="star2" name="star_rating" value="2" <?= $this->Custom->checkRatingRadio($review, 2) ?> /><label data-toggle="tooltip" data-placement="top" title="Poor" for="star2" title="Poor"></label>
                    <input type="radio" id="star1" name="star_rating" value="1" <?= $this->Custom->checkRatingRadio($review, 1) ?> /><label data-toggle="tooltip" data-placement="top" title="Terrible" for="star1" title="Terrible"></label>
                </fieldset>
            </div>
            <div class="col-xs-5 mt-1 ml-2"><span class="badge p-2 badge-primary bold h2">Click to rate!</span></div>
        </div>
        <input type="hidden" name="recommend" value="<?= ($recommend and !$positive_recommendation)  ? "0" : "1" ?>" />
        <input type="hidden" name="business_id" value="<?= $business->id ?>" />
        <input type="hidden" name="edit_review" value="<?= (isset($edit_review) and $edit_review == true) ? "1" : "0" ?>" />

        <!-- Input -->
        <div class="bold small mb-1">Your review title</div>
        <div class="js-form-message mb-4">
            <input type="text" class="form-control" name="title" placeholder="Summarize your visit or highlight an interesting detail (short and sweet)" aria-label="" required data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please enter a brief title.</div>" data-error-class="u-has-error" data-success-class="u-has-success" value="<?= !empty($review->title) ? $review->title : '' ?>">
        </div>
        <!-- End Input -->

        <!-- Input -->

        <!-- Header -->
        <header class="row justify-content-between align-items-center">
            <div class="col-5">
                <span class="bold small mb-1">Your review</span>
            </div>
            <div class="col-7 col-sm-7 col-md-7" style="text-align: right;">
                <button class="btn btn-link txt-sm text-right" type="button" onClick="window.location.href='#tips'" data-modal-target="#tips" style="white-space:normal">
                    <span class="txt-sm text-primary">Tips for writing a great review </span>
                </button>
            </div>
        </header>
        <!-- End Header -->
        <div class="js-form-message mb-0">


            <textarea class="form-control" rows="5" name="comment" placeholder="Your personal review helps others choose great local businesses. Please don't review this business if you have received a freebie/compensation for writing this review, or if you're in any way connected to the owner or employees." aria-label="write a reiew" required data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please enter your review of this business.</div>" data-error-class="u-has-error" data-success-class="u-has-success"><?= !empty($review->comment) ? $review->comment : '' ?></textarea>
            <!-- Header -->
            <header class="row justify-content-between align-items-center">
                <div class="col-5">

                </div>
                <div class="col-12 col-sm-4 col-md-4">
                    <span class="text-right txt-xs mb-1">(100 character minimum)</span>
                </div>
            </header>
            <!-- End Header -->
        </div>

        <!-- End Input -->



        <div class="bold small mt-4 mb-1">What sort of visit was
            this?</div>

        <!--Button Group btn-group-->
        <div class="sort_of_visit btn-group-toggle d-flex mb-5" data-toggle="buttons">
            <label class="mb-1 btn btn-outline-secondary btn-custom-toggle-primary flex-fill" id="CouplesButton">
                <input type="radio" name="sort_of_visit" id="option1" value="Couples">
                Couples
            </label>
            <label class=" mb-1 btn btn-outline-secondary btn-custom-toggle-primary flex-fill" id="FamilyButton">
                <input type="radio" name="sort_of_visit" id="option2" value="Family">
                Family
            </label>
            <label class="mb-1 btn btn-outline-secondary btn-custom-toggle-primary flex-fill" id="FriendsButton">
                <input type="radio" name="sort_of_visit" id="option3" value="Friends">
                Friends
            </label>
            <label class="mb-1 btn btn-outline-secondary btn-custom-toggle-primary flex-fill" id="BusinessButton">
                <input type="radio" name="sort_of_visit" id="option4" value="Business">
                Business
            </label>
            <!--btn btn-outline-secondary btn-cucard-header stom-toggle-primary flex-fill-->
            <label class="mb-1 btn btn-outline-secondary btn-custom-toggle-primary flex-fill" id="SoloButton">
                <input type="radio" name="sort_of_visit" id="option5" value="Solo">
                Solo
            </label>
        </div>
        <!-- End Button Group -->


        <div class="bold small mb-1">When did you visit?</div>

        <div class="row">
            <!-- Input -->
            <div class="col-md-6 mb-4">
                <div class="js-form-message">
                    <div class="js-focus-state form-group">
                        <select class="custom-select" name="visit_time" value="" required>
                            <!--<option value="">When did you visit?</option>-->
                            <option value="<?= date('Y-m', time()); ?>" <?= !empty($review) and $review->visit_time == date('Y-m', time()) ? 'selected' : '' ?>>
                                <?= date('F Y', time()); ?>
                            </option>
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?= date('Y-m', strtotime("-" . $i . " months")); ?>" <?= (!empty($review) and $review->visit_time == date('Y-m', strtotime("-" . $i . " months"))) ? 'selected' : '' ?>>
                                    <?= date('F Y', strtotime("-" . $i . " months")); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- End Input -->
        </div>

        <div class="bold small mb-4 ">Click to select a rating</div>
        <div class="mb-4">

            <div class="row select_rating">
                <?php
                foreach ($review_options as $key => $review_option) : ?>
                    <div class="col-sm-3 small"><?= $review_option->icon ?><?= $review_option->name ?></div>
                    <div class="col-sm-4">
                        <div class="row no-gutters">
                            <div class="col-xs-5 clearfix mb-3">
                                <fieldset class="rating">
                                    <input <?= $this->Custom->checkReviewOptionRatingRadio($review, $review_option, 5) ?> required type="radio" id="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star5" name="ratings[<?= $review_option->id ?>]" value="5" /><label data-toggle="tooltip" data-placement="top" title="Excellent" for="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star5" title="Excellent"></label>
                                    <input <?= $this->Custom->checkReviewOptionRatingRadio($review, $review_option, 4) ?> required type="radio" id="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star4" name="ratings[<?= $review_option->id ?>]" value="4" /><label data-toggle="tooltip" data-placement="top" title="Very Good" for="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star4" title="Very Good"></label>
                                    <input <?= $this->Custom->checkReviewOptionRatingRadio($review, $review_option, 3) ?> required type="radio" id="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star3" name="ratings[<?= $review_option->id ?>]" value="3" /><label data-toggle="tooltip" data-placement="top" title="Average" for="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star3" title="Average"></label>
                                    <input <?= $this->Custom->checkReviewOptionRatingRadio($review, $review_option, 2) ?> required type="radio" id="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star2" name="ratings[<?= $review_option->id ?>]" value="2" /><label data-toggle="tooltip" data-placement="top" title="Poor" for="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star2" title="Poor"></label>
                                    <input <?= $this->Custom->checkReviewOptionRatingRadio($review, $review_option, 1) ?> required type="radio" id="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star1" name="ratings[<?= $review_option->id ?>]" value="1" /><label data-toggle="tooltip" data-placement="top" title="Terrible" for="<?= $this->Custom->removeAllWhiteSpaces($review_option->name) ?>star1" title="Terrible"></label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 small"></div>
                <?php endforeach; ?>

            </div>
            <div class="bold small mt-5 mb-1">What tip or advice do you have for visitors?
            </div>
            <!-- Input -->
            <div class="js-form-message mb-4">


                <input type="text" class="form-control" name="advice" placeholder="What tip or advice do you have for visitors?" aria-label="" required data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please give a brief tip or advice.</div>" data-error-class="u-has-error" data-success-class="u-has-success" value="<?= !empty($review->advice) ? $review->advice : '' ?>">
            </div>
            <!-- End Input -->

            <div class="row">
                <div class="col-md-12">
                    <div class="small bold"> Have photos of this business? Want to share?
                        <span class="optionalnote">(optional)</span></div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-soft-facebook btn-smsq bold mb-1" onClick="window.location.href='#addphotoModal'" data-modal-target="#addphotoModal">Add photo</button>
                    <div id="uploadedcontainer" class="mt10">
                    </div>
                    <img id="rimg" src="" height="50px" width="50px" style="display:none">
                </div>
            </div>

            <?php if (($this->request->getParam('prefix') != 'Admin')) { ?>
                <!-- Checkbox -->
                <div class="js-form-message mt-4 mb-5">
                    <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox" required data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please accept our Terms and Conditions.</div>" data-error-class="u-has-error" data-success-class="u-has-success">
                        <label class="custom-control-label" for="termsCheckbox">
                            <small>
                                I agree to the
                                <a class="link-muted" href="../pages/terms.html">Terms and
                                    Conditions</a>
                            </small>
                        </label>
                    </div>
                </div>
                <!-- End Checkbox -->
            <?php } ?>

            <input type="hidden" name="admin" value="<?= ($this->request->getParam('prefix') == 'Admin') ? "1" : "0" ?>" />
            <input type="hidden" name="user_id" value="<?= !empty($review->user_id) ? $review->user_id : (!empty($currentUser) ? $currentUser->id : '') ?>" />

            <div class="text-center">
                <div class="mb-2">
                    <?php if (($this->request->getParam('prefix') == 'Admin')) { ?>
                        <button type="submit" class="btn btn-smsq bold btn-primary">Update Review</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-smsq bold btn-primary"><?= (isset($edit_review) and $edit_review == true) ? "Update" : "Submit" ?> Your
                            Review</button>

                    <?php } ?>
                </div>
                <p class="small">Your review will be added immediately upon submission.</p>
            </div>

        </div>


    </form>
    <!-- End Hire Us Form -->

    <!-- End Body -->


</div>

<!-- End Recommend Form Modal Window -->


<script>
    var count = 0;

    function addReviews() {

        var photos = getUploadedPhotosData();
        if (photos) {
            $input = $('<input type="hidden" name="photos"/>').val(photos);
            $('#review_form').append($input);
        }

        var data = $('#review_form').serialize();

        block();

        console.log(data);
        // return;

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            // enctype: 'multipart/form-data',
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'addReviews']); ?>",
            data: data,
            cache: false,
            success: function(response) {
                unblock();
                if (response.success) {
                    // uploadReviewPhotos(response.business_review_id);                    
                    window.location = "<?php echo $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]);  ?>";
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(error) {
                // console.log(error);
                unblock();
                $('.upload_preload').css('display', 'none');
            }
        });
    }

    $(document).ready(function() {

        // ToastMessage('<i class="fa fa-exclamation fa-2x"></i> Degee nwane', "error", 3000);

        <?php if (!empty($review->sort_of_visit)) { ?>
            $('#<?= $review->sort_of_visit ?>Button').button('toggle');
        <?php } else { ?>
            $('#CouplesButton').button('toggle');
        <?php } ?>


        $('#review_form').on('submit', function(e) {
            e.preventDefault();
            var error = $(this).find('.u-has-error');
            // var cate = $('input[name=category]').val();
            if (!$(this).valid()) return false;
            if (loggedIn) {
                // var formData = new FormData(this);
                // var data = $(this).serialize();
                addReviews();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                addReview = true;
            }
        });

        // var showChar = 255; // How many characters are shown by default
        // var ellipsestext = "...";
        // var moretext = "Read more &nbsp;<i class='fa fa-caret-down'></i>";
        // var lesstext = 'Read less &nbsp;<i class="fa fa-caret-up"></i>';
        // $('.review_comment').each(function() {
        //     var content = $(this).html();
        //     console.log(content.length);
        //     if (content.length > showChar) {

        //         var c = content.substr(0, showChar);
        //         var h = content.substr(showChar, content.length - showChar);

        //         var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:;" class="txt-12 mt-2 morelink">' + moretext + '</a></span>';

        //         $(this).html(html);
        //     }

        // });
        // $(".morelink").click(function() {
        //     if ($(this).hasClass("less")) {
        //         $(this).removeClass("less");
        //         $(this).html(moretext);
        //     } else {
        //         $(this).addClass("less");
        //         $(this).html(lesstext);

        //     }

        //     $(this).parent().prev().toggle('fast');
        //     $(this).prev().toggle('fast');

        //     return false;
        // });
    })
</script>