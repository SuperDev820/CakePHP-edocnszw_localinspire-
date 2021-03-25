<style>
    .text-gray {
        color: #484d51 !important;
    }
</style>
<div class="activity_content">
    <?php if ($activities_total_count  > 0) { ?>
        <?php foreach ($activitiesArray as $index => $activity) { ?>
            <?php if (!empty($activity->business_review)) {  ?>
                <?php $rec = $activity->business_review->recommend == true  ? "<i class='fas fa-heart text-danger txt-12'></i> recommends" : " <i class='fas fa-heart-broken txt-12'></i> doesn't recommend";  ?>
                <div class="card pt-3 mb-3">
                    <?= $this->element('review_author', ['review' => $activity->business_review, 'rec' => $rec, 'isUserActivity' => true]) ?>

                    <div class="row no-gutters mb-0 mt-3 review_image_gallery" id="slide<?= $activity->business_review->id ?>" style="position: relative;">
                        <?php
                        $over_three = 0;
                        $review_photo_count = count($activity->business_review->business_review_photos);
                        for ($p = 0; $p < $review_photo_count; $p++) {
                            $photo = $activity->business_review->business_review_photos[$p];
                            $show_none = $p == 0 ? "block" : "none";
                            $is_review_photo = "1";
                        ?>
                            <div class="col-sm-12 mb-0 space1">
                                <div class="review-image-gallery-item slideitem<?= $p ?>" style="background-image:url(<?= $this->Custom->getDp($photo->photo, 'reviews') ?>); display: <?= $show_none ?>;width: 100%;position: relative;">
                                    <a class="gallery gallery_item_<?= $photo->id ?>" href="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" data-sub-html="#review_photo_side_model<?= $index ?>_<?= $p ?>" data-src="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" style="display: block;height: 100%;" data-business_id="<?= $activity->business_review->business_id ?>" data-photo_id="<?= $photo->id ?>" data-helfulc="<?= count($photo->helpful_review_photos) ?>" data-is_review_photo="<?= $is_review_photo ?>" data-business_gallery="<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($activity->business_review->business) ? \Cake\Utility\Text::slug(strtolower($activity->business_review->business->name)) : ''), (!empty($activity->business_review->business->city) ? $activity->business_review->business->city->state->code : ''), (!empty($activity->business_review->business) ? $activity->business_review->business->id : '')]); ?>">
                                        <?php if ($over_three == 1 && $p == $review_photo_count - 1) { ?>
                                            <div class="over_photo">
                                                +<?= count($activity->business_review->business_review_photos) - $review_photo_count ?>
                                            </div>
                                        <?php } ?>
                                    </a>
                                    <?php if ($p > 0) { ?>
                                        <a class="prev" href="javascript:currentSlide(<?= $activity->business_review->id ?>,<?= $p - 1 ?>)">&#10094;</a>
                                    <?php } ?>
                                    <?php if ($p < $review_photo_count - 1) { ?>
                                        <a class="next" href="javascript:currentSlide(<?= $activity->business_review->id ?>, <?= $p + 1 ?>)">&#10095;</a>
                                    <?php } ?>
                                    <div class="numbertext"><?= $p + 1 ?> / <?= $review_photo_count ?></div>
                                    <div class="row" id="review_photo_side_model<?= $index ?>_<?= $p ?>" style="display: none;">

                                        <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop pr-3 pl-3">
                                            <!-- Author -->
                                            <div class="media pr pt-3 pb-1">
                                                <div class="u-avatar mr-3">
                                                    <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                                                        <img class="u-avatar border rounded-circle mr-3" src="<?= !empty($photo->user) ?  $this->Custom->getDp($photo->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                                                        <span class="d-block mb-0"><?= ucfirst($photo->user->firstname) . " " . ucfirst(substr($photo->user->lastname, 0, 1)) ?></span>
                                                    </a>
                                                    <small class="d-block txt-12lt text-graylt text-left">Traveler photo
                                                        submitted on <?= $this->Custom->niceDateMonthDayYear($photo->created) ?>.
                                                    </small>
                                                </div>
                                            </div>
                                            <!-- End Author -->

                                            <p class="small text-left mt-2 ml-2 mb-5"><q><?= $photo->caption ?></q></p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="dot_container" style="position: absolute; bottom: 22px; left:50%; -webkit-transform: translate(-50%, 0);-moz-transform: translate(-50%, 0);-ms-transform: translate(-50%, 0);-o-transform: translate(-50%, 0);transform: translate(-50%, 0);" id="sliderdot<?= $activity->business_review->id ?>">
                            <?php for ($p = 0; $p < $review_photo_count; $p++) { ?>
                                <?php $active_dot = $p == 0 ? " active" : ""; ?>
                                <span class="dot <?= $active_dot ?> dotitem<?= $p ?>" onclick="currentSlide(<?= $activity->business_review->id ?>, <?= $p ?>)"></span>
                            <?php } ?>

                        </div>
                    </div>


                    <!--- END REVIEW PHOTOS ---->


                    <div class="bg-lighter px-4">

                        <div class="d-flex align-items-center mt-3">
                            <ul class="list-inline text-white txt-14 mb-1">
                                <?= $this->element('stars_count', ['rating' => $activity->business_review->star_rating]) ?>
                                <span class="text-gray ml-1 font-weight-semi-bold"><?= number_format($activity->business_review->star_rating, 1) ?></span>
                            </ul>

                        </div>
                        <div class="media mt-1">

                            <div class=""><a class="customer-content-wrapa bold mt-5" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($activity->business_review->business->name)), strtolower($activity->business_review->business->city->name), $activity->business_review->business->city->state->code, $activity->business_review->id]); ?>">
                                    <?= $activity->business_review->title ?>
                                </a>
                            </div>

                        </div>


                        <div class="reivew_comment_and_star">
                            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($activity->business_review->business->name)), strtolower($activity->business_review->business->city->name), $activity->business_review->business->city->state->code, $activity->business_review->id]); ?>">
                                <p class="mt-2 font20" id="review_comment<?= $activity->business_review->id ?>">
                                    <?= nl2br($activity->business_review->comment) ?>
                                </p>
                            </a>



                            <div class="bg-white mb-3 mt-3 px-2 border w-65">
                                <div class="d-flex">
                                    <img class="u-avatar align-self-center mr-3" src="<?= $this->Custom->getBusinessPhotoUrl($activity->business_review->business) ?>" alt="<?= $activity->business_review->business->name ?>">
                                    <div>

                                        <a class="txt-14 text-dark bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($activity->business_review->business->name)), strtolower($activity->business_review->business->city->name), $activity->business_review->business->city->state->code, $activity->business_review->business->id]); ?>"><?= $activity->business_review->business->name ?></a>
                                        <ul class="list-inline text-white txt-10 mb-1">
                                            <?= $this->element('stars_count', ['rating' => $activity->business_review->business->average_rating]) ?>
                                            <span class="text-dark star_size12"> &nbsp;&nbsp;<?= $activity->business_review->business->review_count ?> reviews</span>
                                        </ul>
                                        <span class="d-block text-graylt txt-12lt">
                                            <?= !empty($activity->business_review->business->city) ?  $activity->business_review->business->city->name . ", " . strtoupper($activity->business_review->business->city->state->code) : ""; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="px-4">

                    </div>

                    <div class="border-top pt-3 px-3 pb-0">
                        <div class="d-sm-flex align-items-sm-center">

                            <!-- Hourly -->
                            <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                                <h3 class="small text-text-graylt bold mb-0">Date of visit</h3>
                                <small class="fas fa-calendar-alt text-graylt mr-1"></small>
                                <span class="align-middle font-size-1 font-weight-medium"><?= date("F Y", strtotime($activity->business_review->visit_time)) ?></span>
                            </div>
                            <!-- End Hourly -->

                            <!-- Projects -->
                            <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                                <h4 class="small text-text-graylt bold mb-0">Visit type</h4>
                                <small class="fas fa-user-friends text-graylt mr-1"></small>
                                <span class="align-middle font-size-1 font-weight-medium"><?= $activity->business_review->sort_of_visit ?></span>
                            </div>
                            <!-- End Projects -->

                            <!-- Review -->
                            <div class="u-ver-divider--none-sm pr-0 mr-0 mb-3 mb-sm-0">
                                <div class="mb-1"> <?php
                                                    $helpful_count = $activity->business_review->helpful_count;
                                                    $hepful_tag = '<span id="helpfulcount' . $activity->business_review->id . '" ></span>';
                                                    if ($helpful_count == 1) {
                                                        $hepful_tag = '<span id="helpfulcount' . $activity->business_review->id . '" >' . $helpful_count . ' person found this review <span class="fas fa-thumbs-up text-black-50 txt-14 ml-1 mr-1"></span> helpful.</span>';
                                                    } elseif ($helpful_count > 1) {
                                                        $hepful_tag = '<span id="helpfulcount' . $activity->business_review->id . '" >' . $helpful_count . ' people found this review <span class="fas fa-thumbs-up text-black-50 txt-14 ml-1 mr-1"></span> helpful</span>';
                                                    }
                                                    ?>
                                    <a class="text-graylt" href="javascript:;" onclick="new Custombox.modal({ content: { effect: 'fadein', target: '#likedModal<?= $activity->business_review->id ?>' } }).open()">
                                        <h4 class="small text-text-graylt mb-0"><?= $hepful_tag ?></h4>
                                    </a>
                                </div>
                            </div>
                            <!-- End Review -->
                        </div>

                        <div class="border-top mt-3 pt-3">

                            <!-- Likes/Reply -->
                            <ul class="list-inline d-flex">
                                <li class="list-inline-item mr-4">
                                    <a class="txt-12 bold  <?= $this->Custom->isHelpful($activity->business_review) ? "text-primary ungive_helpful_review" : "text-dark give_helpful_review" ?>" data-business_id="<?= $activity->business_review->business_id ?>" data-review_id="<?= $activity->business_review->id ?>" href="javascript:;">
                                        <span class="fas fa-thumbs-up text-black-50 txt-14 mr-1"></span> Helpful
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="txt-12 bold sharereview" href="javascript:;" data-review_id="<?= $activity->business_review->id ?>" data-business_id="<?= $activity->business_review->business_id ?>" data-url="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($activity->business_review->business->name)), strtolower($activity->business_review->business->city->name), $activity->business_review->business->city->state->code, $activity->business_review->id], ['fullBase' => true]); ?>">
                                        <span class="fas fa-share text-black-50 txt-14 mr-1"></span>
                                        Share
                                    </a>
                                </li>

                            </ul>

                            <?php if ($this->Custom->canReply($activity->business_review, $activity->business_review->business) && empty($activity->business_review->business_review_replies)) { ?>
                                <div class="reply_review" id="reply_form_div_<?= $activity->business_review->id ?>">
                                    <div class="text-right">
                                        <a class="btn btn-light btn-sm border bold" data-toggle="collapse" href="#reviewreplymodal<?= $activity->business_review->id ?> " role="button" aria-expanded="false" aria-controls="reviewreplymodal<?= $activity->business_review->id ?>">
                                            Respond to Review
                                        </a>
                                    </div>
                                    <p></p>
                                    <div class="mb-2 collapse border-top" id="reviewreplymodal<?= $activity->business_review->id ?>">
                                        <p class="mb-3 mt-3 small">You may send a quick thank you note to show your appreciation or
                                            respond to a negative review with kindness and in hopes of resolving any issues.</p>
                                        <!-- Icon Blocks Section -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12 mb-12 mb-lg-0">
                                                    <div class="media d-block d-sm-flex ">


                                                        <div class="media-body small">
                                                            <h3 class="h5">Some helpful tips...</h3>

                                                            <div>•&nbsp;Thank your customer for taking the time to provide
                                                                feedback.
                                                            </div>

                                                            <div>•&nbsp;Be sure to address any complaints and explain what you've
                                                                done to address them.
                                                            </div>
                                                            <div>•&nbsp;Always be polite and professional.</div>
                                                            <div>•&nbsp;Ensure that your response meets our guidelines.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Icon Blocks Section -->
                                        <div class="mt-3 small">
                                            <form class="js-validate reply_review_form" method="post" data-parent="reply_form_div_<?= $activity->business_review->id ?>" data-target="reviewreply_<?= $activity->business_review->id ?>">
                                                <input type="hidden" name="review_id" value="<?= $activity->business_review->id ?>" />
                                                <div class="form-group js-form-message ">
                                                    <textarea class="form-control" name="reply" rows="3" aria-label="write a reiew" required="" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please enter your reply of this review.</div>" data-error-class="u-has-error" data-success-class="u-has-success" aria-describedby="comment-error" aria-invalid="false"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm txt-12 mb-1 bold">Submit
                                                    your response
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <?php if (!empty($activity->business_review->business_review_replies)) { ?>

                        <div class="border-top" id="reviewreply_<?= $activity->business_review->id ?>">
                            <div class="p-3">
                                <?= $this->element('review_reply', ['review' => $activity->business_review, 'business' => $activity->business_review->business]) ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="reviewreply_<?= $activity->business_review->id ?>">
                        </div>
                    <?php } ?>
                    <!-- End Likes/Reply -->
                </div>
                <!-- Likes Modal Window -->
                <?= $this->element('review_like_modal', ['review' => $activity->business_review, 'business' => $activity->business_review->business]) ?>
                <!-- End Likes Modal Window -->
                <script>
                    // $(function() {
                    $(document).ready(function() {


                        var $method = $('#slide<?= $activity->business_review->id ?>');
                        $method.lightGallery({
                            thumbnail: true,
                            selector: 'a.gallery',
                            appendSubHtmlTo: '.md-item',
                            addClass: 'fb-comments',
                            mode: 'lg-fade',
                            download: false,
                            enableDrag: false,
                            enableSwipe: false,
                            mousewheel: false,
                            zoom: false,
                            galleryId: 1
                        });
                        $method.on('onAfterSlide.lg', function(event, prevIndex, index) {
                            if (!$('.lg-outer .lg-item').eq(index).attr('data-fb')) {
                                try {
                                    $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                                    FB.XFBML.parse();
                                } catch (err) {
                                    $(window).on('fbAsyncInit', function() {
                                        $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                                        FB.XFBML.parse();
                                    });
                                }
                            }
                        });


                        // var showChar = 255; // How many characters are shown by default
                        // var ellipsestext = "...";
                        // var moretext = "Read more &nbsp;<i class='fa fa-caret-down'></i>";
                        // var lesstext = 'Read less &nbsp;<i class="fa fa-caret-up"></i>';
                        // var content = $('#review_comment<?= $activity->business_review->id ?>').html();
                        // if (content.length > showChar) {
                        //     var c = content.substr(0, showChar);
                        //     var h = content.substr(showChar, content.length - showChar);
                        //     var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:;" class="txt-12 mt-2 morelink">' + moretext + '</a></span>';

                        //     $('#review_comment<?= $activity->business_review->id ?>').html(html);
                        // }

                        $("#review_comment<?= $activity->business_review->id ?> .morelink").click(function() {
                            if ($(this).hasClass("less")) {
                                $(this).removeClass("less");
                                $(this).html(moretext);
                            } else {
                                $(this).addClass("less");
                                $(this).html(lesstext);

                            }

                            $(this).parent().prev().toggle('fast');
                            $(this).prev().toggle('fast');

                            return false;
                        });
                    })
                </script>

            <?php } elseif (!empty($activity->business_photo) or !empty($activity->business_review_photo)) { ?>
                <?php
                $activity_photo = (!empty($activity->business_photo) ? $activity->business_photo : $activity->business_review_photo);
                $activity_business = (!empty($activity->business_photo) ? $activity->business_photo->business : $activity->business_review_photo->business_review->business);
                $is_review_photo = (!empty($activity->business_photo) ? "0" : "1");
                $random_id_target = "photo_block" . mt_rand(100000, 999999);
                $photo_folder = !empty($activity->business_photo) ? "businesses" : "reviews";
                ?>
                <div class="card pt-3 mb-3">
                    <div class="row">
                        <div class="col-10 px-4">
                            <!-- Card -->
                            <div class="media">
                                <div class="u-avatar mr-3">
                                    <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $activity_photo->user->username]); ?>">
                                        <img class="u-avatar border rounded-circle mr-3" src="<?= !empty($activity_photo->user) ?  $this->Custom->getDp($activity_photo->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"></a>
                                </div>
                                <div class="media-body">
                                    <h6 class="d-inline-block mb-1 font-weight-normal small">
                                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $activity_photo->user->username]); ?>"><?= ucfirst($activity_photo->user->firstname) . " " . ucfirst(substr($activity_photo->user->lastname, 0, 1)) ?>.
                                        </a> posted a photo ─ <?= $this->Custom->niceDateMonthDayYear($activity_photo->created) ?>
                                        <span class="d-block txt-12 text-gray-dark">
                                            <i class="fas fa-map-marker-alt txt-12 text-gray-dark"></i>
                                            <?= !empty($activity_photo->user->city) ?  $activity_photo->user->city->name . ", " . strtoupper($activity_photo->user->city->state->code) : ""; ?>
                                            &bull; <?= $this->Custom->userContributions($activity_photo->user) ?> contributions
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <div class="col-2 text-right pr-4">
                            <!-- Icons -->
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-0">
                                    <!-- Settings Dropdown -->
                                    <div class="position-relative">
                                        <a id="createProjectSettingsDropdown<?= $random_id_target . $activity_photo->id ?>Invoker" class="btn btn-sm btn-icon btn-soft-link btn-bg-transparent" href="javascript:;" role="button" aria-controls="createProjectSettingsDropdown<?= $random_id_target . $activity_photo->id ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#createProjectSettingsDropdown<?= $random_id_target . $activity_photo->id ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                            <span class="fas fa-ellipsis-h text-dark btn-icon__inner"></span>
                                        </a>

                                        <div id="createProjectSettingsDropdown<?= $random_id_target . $activity_photo->id ?>" class="dropdown-menu dropdown-unfold border dropdown-menu-right u-unfold--css-animation u-unfold--hidden fadeOut" aria-labelledby="createProjectSettingsDropdown<?= $random_id_target . $activity_photo->id ?>Invoker" style="min-width: 120px; animation-duration: 300ms;">

                                            <a class="dropdown-item photo_report" href="javascript:;" data-photo_id="<?= $activity_photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>" data-business_gallery="<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($activity_business) ? \Cake\Utility\Text::slug(strtolower($activity_business->name)) : ''), (!empty($activity_business->city) ? $activity_business->city->state->code : ''), (!empty($activity_business) ? $activity_business->id : '')]); ?>">Report this</a>
                                        </div>
                                    </div>
                                    <!-- End Settings Dropdown -->
                                </li>

                            </ul>
                            <!-- End Icons -->
                        </div>
                    </div>
                    <!-- Report Review Modal Window -->


                    <!-- End Header -->
                    <!-- End Author -->

                    <!--- BEGIN REVIEW PHOTOS ---->

                    <div class="row no-gutters mb-0 mt-3 review_image_gallery" id="activityphoto<?= $random_id_target . $activity_photo->id ?>" style="position: relative;">

                        <div class="col-sm-12 mb-0 space1">
                            <div class="review-image-gallery-item slide<?= $activity_photo->id ?>" style="background-image:url(<?= $this->Custom->getDp($activity_photo->photo, $photo_folder) ?>);position: relative;width: 100%;display:block">
                                <a class="gallery gallery_item_<?= $activity_photo->id ?>" href="<?= $this->Custom->getDp($activity_photo->photo, $photo_folder) ?>" data-sub-html="#review_photo_side_model<?= $activity_photo->id ?>" data-src="<?= $this->Custom->getDp($activity_photo->photo,  $photo_folder) ?>" style="display: block;height: 100%;" data-bid="<?= $activity_business->id ?>" data-photo_id="<?= $activity_photo->id ?>" data-helfulc="<?= $activity_photo->helpful_count ?>" data-business_gallery="<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($activity_business) ? \Cake\Utility\Text::slug(strtolower($activity_business->name)) : ''), (!empty($activity_business->city) ? $activity_business->city->state->code : ''), (!empty($activity_business) ? $activity_business->id : '')]); ?>">

                                </a>

                                <div class="row" id="review_photo_side_model<?= $activity_photo->id ?>" style="display: none;">

                                    <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop pr-3 pl-3">
                                        <!-- Author -->
                                        <div class="media pr pt-3 pb-1">
                                            <div class="u-avatar mr-3">
                                                <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index',  $activity_photo->user->username]); ?>">
                                                    <img class="u-avatar border rounded-circle mr-3" src="<?= !empty($activity_photo->user) ?  $this->Custom->getDp($activity_photo->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index',  $activity_photo->user->username]); ?>">
                                                    <span class="d-block mb-0"><?= ucfirst($activity_photo->user->firstname) . " " . ucfirst(substr($activity_photo->user->lastname, 0, 1)) ?></span>
                                                </a>
                                                <small class="d-block txt-12lt text-graylt text-left">Traveler photo
                                                    submitted on <?= $this->Custom->niceDateMonthDayYear($activity_photo->created) ?>.
                                                </small>
                                            </div>
                                        </div>
                                        <!-- End Author -->
                                        <p class="small text-left mt-2 ml-2 mb-5"><q><?= $activity_photo->caption ?></q></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--- END REVIEW PHOTOS ---->


                    <div class="bg-lighter pt-3 px-2 border-bottom">
                        <p class="font-size-12"><?= $activity_photo->caption ?></p>

                        <div class="px-4 mt-3">
                            <div class="bg-white mb-3 px-2 borderlt w-65">
                                <div class="d-flex">
                                    <img class="u-avatar align-self-center mr-3" src="<?= $this->Custom->getBusinessPhotoUrl($activity_business) ?>" alt="<?= $activity_business->name ?>">
                                    <div>

                                        <a class="txt-12 text-dark bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($activity_business->name)), strtolower($activity_business->city->name), $activity_business->city->state->code, $activity_business->id]); ?>"><?= $activity_business->name ?></a>
                                        <ul class="list-inline text-white txt-10 mb-1">
                                            <?= $this->element('stars_count', ['rating' => $activity_business->average_rating]) ?>
                                            <span class="text-dark star_size12"> &nbsp;&nbsp;<?= $activity_business->review_count ?>
                                                reviews</span>
                                        </ul>
                                        <span class="d-block text-graylt txt-12lt">
                                            <?= !empty($activity_business->city) ?  $activity_business->city->name . ", " . strtoupper($activity_business->city->state->code) : ""; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" pl-3">

                        <?php
                        $helpful_count =  $activity_photo->helpful_count;
                        $hepful_tag = '<span class="helpfulcount' .  $activity_photo->id . '"></span>';
                        if ($helpful_count == 1) {
                            $hepful_tag = '<div class="border-bottom pb-3"><span class="helpfulcount' .  $activity_photo->id . '" >' . $helpful_count . ' person found this helpful.</span></div>';
                        } elseif ($helpful_count > 1) {
                            $hepful_tag = '<div class="border-bottom pb-3"><span class="helpfulcount"' .  $activity_photo->id . '" >' . $helpful_count . ' people found this helpful.</span></div>';
                        }
                        ?>

                        <div class="">
                            <p class="text-dark small">
                                <a class="txt-12 text-grayxlt" href="javascript:;" onclick="new Custombox.modal({ content: { effect: 'fadein', target: '#likedModal<?= $random_id_target . $activity_photo->id ?>' } }).open()">
                                    <?= $hepful_tag ?>
                                </a>
                            </p>
                        </div>
                        <!-- Likes/Reply -->
                        <ul class="list-inline d-flex">
                            <li class="list-inline-item mr-4">
                                <a class="txt-12 bold <?= $this->Custom->isHelpfulPhoto($activity_photo) ? "gave_photo_helpful" : "photo_helpful" ?>" data-photo_id="<?= $activity_photo->id ?>" data-helfulc="<?= $activity_photo->helpful_count ?>" data-is_review_photo="<?= $is_review_photo ?>" href="javascript:;">
                                    <span class="fas fa-thumbs-up text-black-50 txt-14 mr-1"></span> Helpful
                                </a>
                            </li>
                            <li class="list-inline-item">

                            </li>

                        </ul>
                    </div>
                </div>

                <?= $this->element('photo_like_modal', [
                    'photo' =>  $activity_photo, 'business' => $activity_business,
                    'random_id_target' => $random_id_target
                ]) ?>
                <!-- Likes Modal Window -->

                <!-- End Likes Modal Window -->
                <script>
                    // $(function() {

                    $(document).ready(function() {

                        var $method = $('#activityphoto<?= $random_id_target . $activity_photo->id ?>');
                        $method.lightGallery({
                            thumbnail: true,
                            selector: 'a.gallery',
                            appendSubHtmlTo: '.md-item',
                            addClass: 'fb-comments',
                            mode: 'lg-fade',
                            download: false,
                            enableDrag: false,
                            enableSwipe: false,
                            mousewheel: false,
                            zoom: false,
                            galleryId: 1
                        });
                        $method.on('onAfterSlide.lg', function(event, prevIndex, index) {
                            if (!$('.lg-outer .lg-item').eq(index).attr('data-fb')) {
                                try {
                                    $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                                    FB.XFBML.parse();
                                } catch (err) {
                                    $(window).on('fbAsyncInit', function() {
                                        $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                                        FB.XFBML.parse();
                                    });
                                }
                            }
                        });
                    });
                </script>
            <?php } else { ?>
                <!-- <H1>no content</H1> -->
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <div class="card pt-3 mb-4 text-center pb-4 ">
            <i class="fas fa-images fa-3x"></i>
            <h5>
                <h4 class="bold">No Photos or Reviews
                    yet</h4> <?= ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) ?>. hasn't posted
                any photos and reviews yet.
            </h5>
        </div>

    <?php } ?>
    <!-- End Review Details -->


    <script>
        $(document).ready(function() {
            //$('.show_more').css('display', "");
            // alert("yeah");

            $.SRCore.components.SRUnfold.init($('[data-unfold-target]'), {
                // afterOpen: function() {
                //     $(this).find('input[type="search"]').focus();
                // }
            });


        })
    </script>
</div>