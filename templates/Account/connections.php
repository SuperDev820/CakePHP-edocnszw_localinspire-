<?php $this->assign('title', 'Connections'); ?>
<!-- Content Section -->
<div class="bg-light">
    <div class="container space-2">
        <?= $this->element('accountsidenav') ?>

        <div class="card p-5">
            <!-- Title -->
            <div class="row justify-content-between align-items-end">
                <div class="col-10 txt-14">
                    <h2 class="h5 bold mb-0">Social Connecting</h2> Connect to facebook google, and twitter and share your experiences with your friends and family.
                </div>
                <div class="col-2 text-right">

                </div>
            </div>
            <!-- End Title -->
            <hr class="mt-2 mb-4">
            <form id="social_connection">
                <!-- My Network -->

                <?php if ($currentUser->is_connect_fb) { ?>
                    <div class="mb-3">
                        <!-- Facebook Connect -->
                        <div class="mb-3">
                            <h4 class="text-dark"><i class="fab fa-facebook-f"></i> &nbsp; Facebook</h4>Share your reviews on Facebook
                        </div>
                        <div class="mb-3  txt-14">When you write new reviews, you can automatically have localinspire post your review to facebook and spread the word! You will always have an option not to post a review to facebook. </div>

                        <!-- User Info -->
                        <div class="media d-block d-sm-flex align-items-sm-center">
                            <div class="u-lg-avatar position-relative mb-3 mb-sm-0 mr-5">
                                <img style="height:85px;width:85px" class="img-fluid border rounded-circle" src="<?= !empty($currentUser->facebook_image) ?  $currentUser->facebook_image : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                            </div>
                            <div class="media-body">
                                <h5 class="h5 text-dark font-weight-medium mb-1"><i class="fas fa-check text-primary"></i> &nbsp;You're connected to Facebook</h5>
                                <span class="d-block text-dark"><button type="button" class="btn btn-light borderlt btn-sm " onclick="javascript:disconnect_facebook();"> <i class="fab fa-facebook-f"></i> &nbsp;Disconnect from Facebook</button></span>
                            </div>
                        </div>
                        <!-- End Facebook Connect -->
                    </div>
                    <hr class="mb-3 mt-5">

                    <!-- Facebook Account Activity -->
                    <div class="mb-3">
                        <!-- Title -->
                        <div class="row justify-content-between align-items-end">
                            <div class="col-8">
                                <h2 class="h6 bold mb-0 txt-14">Auto follow friends from Facebook and share options: </h2>

                            </div>

                        </div>
                        <!-- End Title -->

                        <hr class="mb-3">

                        <!-- Checkbox Switch -->
                        <div class="media align-items-center mb-3">
                            <label class="checkbox-switch mb-0 mr-3">
                                <input type="checkbox" class="checkbox-switch__input" id="auto_follow_friends_face" <?= $currentUser->auto_follow_fb_friends ? " checked" : "" ?>>
                                <span class="checkbox-switch__slider"></span>
                            </label>
                            <label class="media-body text-muted mb-0" for="auto_follow_friends_face">
                                <span class="d-block text-dark txt-14">Automatically follow friends from Facebook when they join Localinspire</span>
                            </label>
                        </div>
                        <!-- End Checkbox Switch -->

                        <!-- Checkbox Switch -->
                        <div class="media align-items-center mb-3">
                            <label class="checkbox-switch mb-0 mr-3">
                                <input type="checkbox" class="checkbox-switch__input" id="share_review_face" <?= $currentUser->share_review_fb ? " checked" : "" ?>>
                                <span class="checkbox-switch__slider"></span>
                            </label>
                            <label class="media-body text-muted mb-0" for="share_review_face">
                                <span class="d-block text-dark txt-14">Share your localinspire reviews on facebook.</span>
                            </label>
                        </div>
                        <!-- End Checkbox Switch -->

                        <!-- Checkbox Switch -->
                        <div class="media align-items-center mb-3">
                            <label class="checkbox-switch mb-0 mr-3">
                                <input type="checkbox" class="checkbox-switch__input" id="share_business_photo_face" <?= $currentUser->share_business_photo_fb ? " checked" : "" ?>>
                                <span class="checkbox-switch__slider"></span>
                            </label>
                            <label class="media-body text-muted mb-0" for="share_business_photo_face">
                                <span class="d-block text-dark txt-14">Share your localinspire business photos on facebook.</span>
                            </label>
                        </div>
                        <!-- End Checkbox Switch -->
                    </div>
                    <!-- End Facebook Account Activity -->
                <?php } else { ?>
                    <div class="mb-3">
                        <h4 class="text-dark"><i class="fab fa-facebook-f"></i> &nbsp; Facebook</h4>Share your reviews on Facebook
                    </div>
                    <div class="mb-3 txt-14">When you write new reviews, you can automatically have localinspire post your review to facebook and spread the word! You will always have an option not to post a review to facebook. </div>

                    <button type="button" class="btn btn-facebook mb-1 " onclick="fblogin_for_connect();"><i class="fab fa-facebook-f"></i> &nbsp; Connect to Facebook</button>
                <?php } ?>

                <?php if ($currentUser->is_connect_twitter) { ?>
                    <!-- Twitter Connect -->

                    <div class="mb-6">

                        <hr class="mt-2 mb-4">

                        <div class="mb-3">
                            <h4 class="text-dark"><i class="fab fa-twitter"></i> &nbsp; Twitter</h4>Tweet your reviews on Twitter
                        </div>
                        <div class="mb-3 txt-14">When you write new reviews, you can automatically have localinspire post a link to Twitter and spread the word! You will always have an option not to post a review to Twitter.</div>

                        <!-- User Info -->
                        <div class="media d-block d-sm-flex align-items-sm-center">
                            <div class="u-lg-avatar position-relative mb-3 mb-sm-0 mr-5">
                                <img style="height:85px;width:85px" class="img-fluid border rounded-circle" src="<?= !empty($currentUser->twitter_image) ?  $currentUser->twitter_image : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                            </div>
                            <div class="media-body">
                                <h5 class="h5 text-dark font-weight-medium mb-1"><i class="fas fa-check text-primary"></i> &nbsp;You're connected to Twitter</h5>
                                <span class="d-block text-dark"><button type="button" class="btn btn-light borderlt btn-sm" onclick="javascript:disconnect_twitter();"> <i class="fab fa-twitter"></i> &nbsp;Disconnect from Twitter</button></span>
                            </div>
                        </div>
                        <!-- End Twitter Connect -->
                    </div>
                    <hr class="mb-3">

                    <!-- Twitter Account Activity -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="auto_tweet_review" <?= $currentUser->auto_tweet_review ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="	auto_tweet_review">
                            <span class="d-block text-dark txt-14">Automatically Tweet reviews when I post one.</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="auto_tweet_photo" <?= $currentUser->auto_tweet_photo  ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="auto_tweet_photo">
                            <span class="d-block text-dark txt-14">Automatically Tweet photos when I upload one.</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- End Twitter Activity -->
                <?php } else { ?>
                    <hr class="mt-2 mb-4">

                    <div class="mb-3">
                        <h4 class="text-dark"><i class="fab fa-twitter"></i> &nbsp; Twitter</h4>Tweet your reviews on Twitter
                    </div>
                    <div class="mb-3 txt-14">When you write new reviews, you can automatically have localinspire post a link to Twitter and spread the word! You will always have an option not to post a review to Twitter.</div>
                    <button type="button" class="btn btn-twitter mb-1" onclick="twitter_connect();"><i class="fab fa-twitter"></i> &nbsp; Connect to Twitter</button>
                <?php } ?>

                <?php if ($currentUser->is_connect_google) { ?>
                    <div class="mb-6">
                        <hr class="mt-2 mb-4">
                        <div class="mb-3">
                            <h4 class="text-dark"><i class="fab fa-google"></i> &nbsp; Google</h4>Connect your account with Google
                        </div>
                        <!-- User Info -->
                        <div class="media d-block d-sm-flex align-items-sm-center">
                            <div class="u-lg-avatar position-relative mb-3 mb-sm-0 mr-5">
                                <img style="height:85px;width:85px" class="img-fluid border rounded-circle" src="<?= !empty($currentUser->google_image) ?  $currentUser->google_image : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                            </div>
                            <div class="media-body">
                                <h5 class="h5 text-dark font-weight-medium mb-1"><i class="fas fa-check text-primary"></i> &nbsp;You're connected to Google</h5>
                                <span class="d-block text-dark"><button type="button" class="btn btn-light borderlt btn-sm " onclick="javascript:disconnect_google();"> <i class="fab fa-google"></i> &nbsp;Disconnect from Google</button></span>
                            </div>
                        </div>
                        <!-- End Twitter Connect -->
                    </div>
                <?php } else { ?>
                    <hr class="mt-2 mb-4">

                    <div class="mb-3">
                        <h4 class="text-dark"><i class="fab fa-google"></i> &nbsp; Google</h4>Connect your account with Google
                    </div>
                    <button type="button" class="btn btn-google mb-1 " onclick="google_login_for_connect();"><i class="fab fa-google"></i> &nbsp; Connect to Google</button>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<!-- End Content Section -->

<!-- ========== END MAIN ========== -->
<script>
    $(document).ready(function() {
        // connect_with_twitter();
        // load_connection_data();
        // social_side_connection();
        // $('#social_connection').on('click', '.disconnect_google', function(){
        //     console.log("disconnect google");
        // })

        // $('#social_connection').on('click', '.disconnect_facebook', function(){
        //     console.log("disconnect_facebook");
        // })
        $('#social_connection').on('change', 'input[id=auto_follow_friends_face]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateSocialOptions({
                auto_follow_fb_friends: status
            });

        })

        $('#social_connection').on('change', 'input[id=share_review_face]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateSocialOptions({
                share_review_fb: status
            });

        })

        $('#social_connection').on('change', 'input[id=share_business_photo_face]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateSocialOptions({
                share_business_photo_fb: status
            });


        })

        $('#social_connection').on('change', 'input[id=auto_tweet_photo]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateSocialOptions({
                auto_tweet_photo: status
            });


        })

        $('#social_connection').on('change', 'input[id=auto_tweet_review]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            updateSocialOptions({
                auto_tweet_review: status
            });



        })



    })
</script>