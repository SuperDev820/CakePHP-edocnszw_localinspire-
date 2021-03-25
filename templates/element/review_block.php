<?php $rec = $review->recommend ? "<i class='fas fa-heart text-danger txt-12'></i> recommends" : " <i class='fas fa-heart-broken txt-12'></i> doesn't recommend"; ?>
  

<div class="card pt-3 mt-4 mb-4">

    <!--- BEGIN REVIEW PHOTOS ---->
    <?php if (!isset($showinghistory)) { ?>
        <?= $this->element('review_author', ['review' => $review, 'rec' => $rec]) ?>
        
          <!-- Begin Review Stats-->
        
        <div class="mt-2 pt-3 px-4 pb-0">
        <div class="d-sm-flex align-items-sm-center">

            <!-- Hourly -->
            <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0 small">
                <h4 class="txt-12lt text-text-graylt bold mb-0">Date of visit</h4>
               <small class="fas fa-calendar-alt text-graylt mr-1"></small>
                <span class="align-middle txt-12lt font-weight-medium"><?= date("F Y", strtotime($review->visit_time)) ?></span>
               
              
            </div>
            <!-- End Hourly -->
 <!-- Review -->
            <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0 small">
                <h4 class="txt-12lt text-text-graylt bold mb-0">Date Reviewed</h4>
               <small class="fas fa-calendar-alt text-graylt mr-1"></small>
                <span class="align-middle txt-12lt font-weight-medium"><?= $this->Custom->niceDateMonthDayYear($review->created) ?></span>
               
              
            </div>
            <!-- End Review -->
            <!-- Projects -->
            <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                <h4 class="txt-12lt text-text-graylt bold mb-0">Visit type</h4>
                <small class="fas fa-user-friends text-graylt mr-1"></small>
                <span class="align-middle txt-12lt font-weight-medium"><?= $review->sort_of_visit ?></span>
            </div>
            <!-- End Projects -->

           
            <?php if (!isset($showinghistory)) { ?>
                <!-- Review -->
                
                
                
                
                
                
                
                
                
                <div class=" u-ver-divider--none-sm pr-0 mr-0 mb-3 mb-sm-0">
                    <div class="mb-1">
                        <?php
                        $helpful_count = count($review->helpful_reviews);
                        $hepful_tag = "<span id='helpfulcount" . $review->id . "'>No helpful votes, was it helpful to you?</span>";
                        if ($helpful_count == 1) {
                            $hepful_tag = "<span id='helpfulcount" . $review->id . "'>" . $helpful_count . " person found this review <span class='fas fa-thumbs-up text-black-50 txt-14 ml-1 mr-1'></span> helpful.</span>";
                        } elseif ($helpful_count > 1) {
                            $hepful_tag = "<span id='helpfulcount" . $review->id . "' >" . $helpful_count . " people found this review <span class='fas fa-thumbs-up text-black-50 txt-14 ml-1 mr-1'></span> helpful</span>";
                        }
                        ?>
                        <a class="text-body" href="javascript:;" onclick="new Custombox.modal({ content: { effect: 'fadein', target: '#likedModal<?= $review->id ?>' } }).open()">
                            <h4 class="small text-graylt mb-0"><?= $hepful_tag ?></h4>
                        </a>
                    </div>
                </div>
                
            <?php } ?>
        </div></div>
        
         <!-- End Review Stats-->
        
        
        <div class="row no-gutters mb-0 mt-3 review_image_gallery">
            <?php
            $over_three = 0;
            $review_photo_count = (count($review->business_review_photos) > 3) ? 3 : count($review->business_review_photos);
            $over_three = (count($review->business_review_photos) > 3) ? 1 : 0;
            $height = ($review_photo_count == 3) ? " rimgh" : " rimgh1";
            for ($p = 0; $p < $review_photo_count; $p++) {
                $photo = $review->business_review_photos[$p];
            ?>
                <div class="col-sm-<?= 12 / $review_photo_count ?> mb-0 space1">
                    <div class="review-image-gallery-item" style="width:100%;background-image:url(<?= $this->Custom->getDp($photo->photo, 'reviews') ?>)">
                        <a class="gallery gallery_item_<?= $photo->id ?>" href="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" data-sub-html="#review_photo_side_model<?= $review->id ?>_<?= $p ?>" data-src="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" style="display: block;height: 100%;" data-business_id="<?= $review->business_id ?>" data-photo_id="<?= $photo->id ?>" data-helfulc="<?= count($photo->helpful_review_photos) ?>" data-is_review_photo="1" data-business_gallery="<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($review->business) ? \Cake\Utility\Text::slug(strtolower($review->business->name)) : ''), (!empty($review->business->city) ? $review->business->city->state->code : ''), (!empty($review->business) ? $review->business->id : '')]); ?>">
                            <?php if ($over_three == 1 && $p == $review_photo_count - 1) { ?>
                                <div class="over_photo">+<?= count($review->business_review_photos) - $review_photo_count ?></div>
                            <?php } ?>
                        </a>
                        <div class="row" id="review_photo_side_model<?= $review->id ?>_<?= $p ?>" style="display: none;">

                            <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop pr-3 pl-3">
                                <!-- Author -->
                                <div class="media pr pt-3 pb-1">
                                    <div class="u-avatar mr-3">
                                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                                            <img class="img-fluid rounded-circle" src="<?= !empty($photo->user) ?  $this->Custom->getDp($photo->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                                            <span class="d-block mb-0"><?= ucfirst($photo->user->firstname) . " " . ucfirst(substr($photo->user->lastname, 0, 1)) ?></span>
                                        </a>
                                        <small class="d-block txt-12lt text-graylt text-left">Traveler photo submitted
                                            on <?= $this->Custom->niceDateMonthDayYear($photo->created) ?>.
                                        </small>
                                    </div>
                                </div>
                                <!-- End Author -->

                                <p class="small text-left mt-2 ml-2 mb-5"><q><?= $photo->caption ?></q></p>


                                <!--							<div class="txt-xs mb-5 text-right">Sponsored links &nbsp;&nbsp;<span data-toggle="popover" data-html="true" data-placement="top" data-trigger="hover" data-content="<span class='small'>A business owner paid for this ad. For more information visit our business center.</span>"><i class="fa fa-info-circle" aria-hidden="true"></i></span></div>-->

                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="list-unstyled row clearfix" style="display: none;">
                <?php
                for ($p = $review_photo_count; $p < count($review->business_review_photos); $p++) {
                    $photo = $review->business_review_photos[$p];
                ?>
                    <div class="col-sm-4 mb-3 space1">
                        <div class="review-image-gallery-item" style="background-image:url(<?= $this->Custom->getDp($photo->photo, 'reviews') ?>)">
                            <a class="gallery gallery_item_<?= $photo->id ?>" href="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" data-src="<?= $this->Custom->getDp($photo->photo, 'reviews') ?>" data-sub-html="#review_photo_side_model<?= $review->id ?>_<?= $p ?>" style="display: block;" data-business_id="<?= $review->business_id ?>" data-photo_id="<?= $photo->id ?>" data-helfulc="<?= count($photo->helpful_review_photos) ?>" data-is_review_photo="1">

                            </a>
                            <div class="row" id="review_photo_side_model<?= $review->id ?>_<?= $p ?>" style="display: none;">

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
                                            <small class="d-block text-graylt txt-12lt  text-left">Traveler photo submitted
                                                on <?= $this->Custom->niceDateMonthDayYear($photo->created) ?>.
                                            </small>
                                        </div>
                                    </div>
                                    <!-- End Author -->

                                    <p class="small text-left mt-2 ml-2 mb-5"><q><?= $photo->caption ?></q></p>


                                    <!--							<div class="txt-xs mb-5 text-right">Sponsored links &nbsp;&nbsp;<span data-toggle="popover" data-html="true" data-placement="top" data-trigger="hover" data-content="<span class='small'>A business owner paid for this ad. For more information visit our business center.</span>"><i class="fa fa-info-circle" aria-hidden="true"></i></span></div>-->

                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <?php //echo $this->element('review_author', ['review' => $review->business_review, 'rec' => $rec]) 
        ?>
        <div class="row">
            <div class="col-10 px-4">
                <!-- Card -->
                <div class="media">
                    <div class="media-body">
                        <h6 class="d-inline-block mb-1 font-weight-normal small">
                            <?= $this->Custom->niceDateMonthDayYear($review->created) ?>
                        </h6>
                    </div>
                </div>
                <!-- End Card -->
            </div>

        </div>
    <?php } ?>

    <!--- END REVIEW PHOTOS ---->

    <div class="bg-white px-4">

        <div class="d-flex align-items-center mt-3">

        </div>
        <div class="media mt-1">
            <div class="bold">
                <?php if (isset($nolinkurl) and $nolinkurl == true) : ?>
                    <?= $review->title ?>
                <?php else : ?>
                    <a class="customer-content-wrapa bold mt-5" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id]); ?>">
                        <?= $review->title ?>
                    </a>
                <?php endif; ?>

            </div>

        </div>
        
        <div class="reivew_comment_and_star">
            <p class="mt-2 review_comment readmorelink">
                "<?= $review->comment ?>"
            </p>
            <div class="mb-1 mt-3 txt-12 text-gray "><span class="txt-12"><strong><i class="fas fa-lightbulb mr-1"></i> <?= $review->user->firstname  . "'s" ?> tip:</strong> <?= $review->advice ?></span></div>
            
            
      
            
            
            
            
            
          
            
            
            
            
        </div>
    </div>

    <div class="pt-0 px-4 pb-0">
        <div class="d-sm-flex align-items-sm-center">

         
     <!-- Rating -->
        <div class="position-relative mb-5">
          <a id="<?= $review->id ?>DropdownInvoker" class="" href="javascript:;" role="button"
             aria-controls="<?= $review->id ?>Dropdown"
             aria-haspopup="true"
             aria-expanded="false"
             data-unfold-event="hover"
             data-unfold-target="#<?= $review->id ?>Dropdown"
             data-unfold-type="css-animation"
             data-unfold-duration="300"
             data-unfold-delay="300"
             data-unfold-hide-on-scroll="true"
             data-unfold-animation-in="slideInUp"
             data-unfold-animation-out="fadeOut">
            <span class="txt-12 text-gray">
  <i class="fas fa-exclamation-circle"></i> Hover to see review details</span>
          </a>

          <div id="<?= $review->id ?>Dropdown" class="borderlt dropdown-menu dropdown-unfold p-3" aria-labelledby="<?= $review->id ?>DropdownInvoker" style="width: 600px;">
            <div class="mb-2">
                <div class='txt-14 mb-3'><?= $review->user->firstname  . "" ?> <?= $rec ?> <a class="txt-14 text-dark bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id]); ?>"><?= $review->business->name ?></a></div>
                
             <!-- Review -->
            <div class='pr-4 mr-4 mb-3 mb-sm-0 small'><h6 class="txt-15 bold mb-2">Overal Rating</h6>
                <div class='text-white txt-12 mb-1'>
                    <div class='align-items-center'>
                        <span class='list-inline text-white star_size12 mb-1'>
                            <?= $this->element('stars_count', ['rating' => $review->star_rating]) ?>
                        </span> <span class="badge badge-sm badge-primary badge-pos rounded-circle"><?= number_format($review->star_rating, 0) ?></span><span class='font-weight-semi-bold ml-2 text-dark'><?= number_format($review->star_rating, 0) ?></span>

                    </div>
                </div>
                
                
            </div>
            <!-- End Review -->
              
           
              
            </div>

            
            
               <div class='text-gray mt-4 txt-12 text-center mb-2' style='width:500px; display: flex; justify-content: space-between;'>
                <?php foreach ($review->review_values as $key => $option) { ?>
                    <div class='select_star<?= $key + 1 ?>' style='float:left;'>
                        <div class='txt-12lt' style='text-align:center'><strong><?= $option->review_option->name ?></strong></div>
                        <div style='text-align:center'>
                            <div class='txt-12' >
                                <?= $option->value . " star" . ($option->value > 1 ? 's' : '') ?>
                            </div>
                           
                           
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                <?php } ?>
                
               
                
            </div>
            
            
            
            
          </div>
        </div>
        <!-- End Rating -->

           
           
        </div>

         <div style="margin-left:-25px;margin-right:-25px" class="mb-3"></div>

        <!-- End helpful List -->

        <div class="">
            <?php if (!isset($showinghistory)) { ?>
                <!-- Likes/Reply -->
                <ul class="list-inline d-flex">
                    <?php if (!empty($currentUser) and $review->business->user_id == $currentUser->id and $review->business->enhanced) { ?>
                        <li class="list-inline-item mr-4">
                            <a class="txt-12 bold sendmessage" data-business_id="<?= $review->business_id ?>" data-review_id="<?= $review->id ?>" data-receieverid="<?= $review->user->id ?>" data-receievername="<?= ucwords($review->user->name_desc) ?>" href="javascript:;">
                                <span class="fa fa-comment text-black-50 txt-14 mr-1"></span> Send Private Message
                            </a>
                        </li>
                    <?php } ?>
                    <li class="list-inline-item mr-4">
                        <a style="text-decoration: none;" class="txt-14 bold <?= $this->Custom->isHelpful($review) ? "text-primary ungive_helpful_review" : "text-black-50 give_helpful_review" ?>" data-business_id="<?= $review->business_id ?>" data-review_id="<?= $review->id ?>" href="javascript:;">
                            <span class="far fa-thumbs-up <?= $this->Custom->isHelpful($review) ? "text-primary ungive_helpful_review" : "text-black-75 give_helpful_review" ?> txt-15 mr-1"></span> Helpful
                        </a>
                    </li>
                    <!-- <li class="list-inline-item mr-4">
                    <a class="text-secondary small" href="#">
                        <span class="far fa-thumbs-down mr-1"></span> Not Helpful
                    </a>
                </li> -->
                    <li class="list-inline-item">
                        <a class="text-black-50 txt-14 bold sharereview" href="javascript:;" data-review_id="<?= $review->id ?>" data-business_id="<?= $review->business_id ?>" data-url="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id], ['fullBase' => true]); ?>">
                            <span class="far fa-share-square text-black-75 txt-15 mr-1"></span>
                            Share
                        </a>
                    </li>

                    <?php if (!empty($review->review_histories)) { ?>
                        <li class="list-inline-item mr-4">
                            <a class="text-secondary txt-12 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReviewHistory', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id], ['fullBase' => true]); ?>">
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="far fa-clock mr-1"></span> View edit history
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($currentUser->id) and $review->user_id == $currentUser->id) { ?>
                        <li class="list-inline-item mr-4">
                            <a class="text-secondary txt-12 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'editReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), $review->business->city->state->code, $review->id], ['fullBase' => true]); ?>">
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="far fa-note mr-1"></span> Update
                            </a>
                        </li>
                        <li class="list-inline-item mr-4">
                            <a class="text-secondary txt-12 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'deleteReview', $review->id]); ?>" onclick="return confirm('Are you sure?')">
                                &nbsp;&nbsp;<span class="far fa-note mr-1"></span> Delete
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            <?php } ?>
            <?php if (!isset($showinghistory)) { ?>
                <?php if ($this->Custom->canReply($review, $business) && empty($review->business_review_replies)) { ?>
                    <div class="reply_review" id="reply_form_div_<?= $review->id ?>">
                        <div class="text-right">
                            <a class="btn btn-light bold borderlt" data-toggle="collapse" href="#reviewreply_<?= $review->id ?>" role="button" aria-expanded="false" aria-controls="reviewreply_<?= $review->id ?>">
                                Respond to Review
                            </a>
                        </div>
                        <p></p>
                        <div class="mb-2 collapse " id="reviewreply_<?= $review->id ?>">
                            
                          <!-- Contacts Section -->
<div class="">
  <div class=" no-gutters border shadow rounded">
    <div class="col-lg-12 bg-primary rounded">
      <div class="p-2 p-md-5">
        <!-- Title -->
        <div class="mb-1">
          <h3 class="text-white">Respond to <?= $review->user->firstname  . "'s" ?> review!</h3>
          <p class="text-light">You may send a quick thank you note to show your appreciation or
                                respond to a negative review with kindness and in hopes of resolving any issues.</p>
                                
                                
            <h5 class="mb-2 text-light">Some helpful tips</h5>
    
    <div class="text-light">•&nbsp;Thank your customer for taking the time to provide
                                                    feedback.
                                                </div>
                                                <div class="text-light">•&nbsp;Be sure to address any complaints and explain what you've
                                                    done to address them.
                                                </div>
                                                <div class="text-light">•&nbsp;Always be polite and professional.</div>
                                                <div class="text-light">•&nbsp;Ensure that your response meets our guidelines.</div>                    
                                
                                
                                
                                
                                
                                
        </div>
        <!-- End Title -->

       

       

      
      </div>
    </div>

    <div class="col-lg-12 bg-gray-100 rounded">                                         
  <div class="pl-3 pr-3 mt-3 small"><b> Add your response:</b>
                                <form class="js-validate reply_review_form" method="post" data-parent="reply_form_div_<?= $review->id ?>" data-target="reviewreply_<?= $review->id ?>">
                                    <input type="hidden" name="review_id" value="<?= $review->id ?>" />
                                    <div class="form-group js-form-message ">
                                        <textarea class="form-control" name="reply" rows="3" aria-label="write a reiew" required="" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please enter your reply of this review.</div>" data-error-class="u-has-error" data-success-class="u-has-success" aria-describedby="comment-error" aria-invalid="false"></textarea>
                                    </div>                                              
                                                
                                                
                                                
                                                
                                                
  </div>

  <div class="card-footer border-0 d-sm-flex justify-content-between align-items-center pt-0 px-6 pb-6">
    <div class="mb-3 mb-sm-0">
      
    </div>

    <div class="text-sm-right">
     <button type="submit" class="btn btn-sm btn-primary">Submit
                                        your response
                                    </button></div> 
     
    </div> </div>
  </div>
</div>
<!-- End Contacts Section -->  
                            


                                </form>
                            
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php if (!isset($showinghistory)) { ?>
            <?php if (!empty($review->business_review_replies)) { ?>
                <div style="margin-left:-25px;margin-right:-25px" class="border-top mb-3"></div>
                <div id="reviewreply_<?= $review->id ?>">
                    <?= $this->element('review_reply', ['review' => $review, 'business' => $business]) ?>
                </div>
            <?php } else { ?>
                <div id="reviewreply_<?= $review->id ?>">
                </div>
            <?php } ?>
        <?php } ?>
        <!-- End Likes/Reply -->
    </div>

</div>
<?php if (!isset($showinghistory)) { ?>
    <!-- Likes Modal Window -->
    <?= $this->element('review_like_modal', ['review' => $review, 'business' => $business]) ?>
    <!-- End Likes Modal Window -->
<?php } ?>