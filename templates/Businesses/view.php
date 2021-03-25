<?php $this->assign('title', $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code) . " - " . $review_counts . " reviews and " . $question_counts . " questions asked"); ?>
<?php $this->assign('image', $this->Custom->getBusinessPhotoUrl($business, true)); ?>
<!-- ========== MAIN ========== -->
<div><!-- Business Photo Modal Window -->
    <?= $this->element('business_photos', ['business_photos' => $business_photos, 'review_photos' => $review_photos, 'all_business_photos' => $all_business_photos]) ?>
    <!-- End Business Photo Modal Window -->
    
    
    <!--============= Business Listing =====================-->
    
    <section class="reserve-block mt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 span class="biz_title"><?= $business->name ?>
                        <?php if (empty($business->user)) { ?>

                            <a href="#" style="font-weight:normal;font-size: 13px;" data-container="body" data-toggle="popover" data-html="true" data-trigger="click" data-placement="bottom" data-content="<b>This business has not yet been claimed by the owner or a representative.</b>
                                        <br><br>
                                        <a href='<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'claim', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>' title='Claim this business!'>Claim this business</a> to make sure your information is up to date, add photos and more. Plus use our free tools to find new customers."><i style="font-size: 16px;" class="fas fa-question-circle text-dark" aria-hidden="true"></i> Unclaimed</a>
                                        
                                        
                               
                                        
                                        
                        <?php } else { ?>
                            <span class="txt-xs">Claimed<!--- <?= $business->business_role->name ?> ---></span>
                        <?php } ?>


                    </h2>
                    <ul class="list-inline text-white star_size18 mb-2">
                        <?= $this->element('stars_count', ['rating' => $business->average_rating]) ?>
                        <span class="small text-secondary"> &nbsp;&nbsp;<?= $review_counts ?>&nbsp; reviews</span>
                    </ul>
                    <span class="d-block"><?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?> </span>

                    <?php
                    // $sic8 = $business['SIC8_Category'];
                    // if (substr($sic8, 0, 1) == ":") {
                    //     $sic8_arr = explode(":", substr($sic8, 1, strlen($sic8)));
                    // } else {
                    //     $sic8_arr = explode(":", $sic8);
                    // }
                    ?>
                    <!-- <span class="d-block"><?php //echo isset($biz_exp) && $biz_exp != "" ? $biz_exp . " &bull; " : ""; 
                                                ?> <?php //echo $business['SIC4_Category'] 
                                                    ?>, <?php //echo implode(", ", $sic8_arr) 
                                                        ?> </span> -->
                    <span class="d-block"><?= $this->Custom->displayCategoriesAndSubcategories($business) ?></span>


                </div>
                <div class="col-md-6">
                    <div class="reserve-seat-block align-items-center">
                        <span class="text-dark"><button style="cursor:pointer;" data-business_id="<?= $business->id ?>" class="btn btn-primary btn-xs bold borderlt mr-1 font17 biz_save"><i class="fas fa-bookmark"></i> &nbsp; Save</button></span>
                        <span class="text-dark"><button type="button" href="#sharebusinessModal" data-modal-target="#sharebusinessModal" class="sharebutton btn btn-light btn-xs bold borderlt mr-1"><i class="far fa-share-square"></i> &nbsp; Share</button></span>
                        <span class="text-dark"><button style="cursor:pointer;" data-business_id="<?= $business->id ?>" class="btn btn-light btn-xs bold borderlt mr-1 biz_add_photo"><i class="fas fa-camera"></i> &nbsp; Add Photo</button></span>
                        <!-- <a 
                        href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addPhotos', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>" 
                        class="btn btn-light btn-xs bold borderlt mr-1"><i class="fas fa-camera"></i> &nbsp; Add Photo</a> -->
                        <?php if (!empty($business->user)) { ?>
                            <button type="button" class="btn btn-light btn-xs bold borderlt mr-1 sendmessage" data-receievername="<?= ucwords($business->user->name_desc) ?>" data-receieverid="<?= $business->user->id ?>"> <span class="far bold fa-envelope mr-2"></span>Message Owner</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add Members Modal Window -->
    <?= $this->element('bookmark_modal') ?>
    <!-- End Add Members Modal Window -->
    <!-- Create List Modal Window -->
    <?= $this->element('create_collection_modal') ?>

    <!-- End Create List Modal Window -->

    <!--End Business Listing -->
    <section class="gray-dark booking-details_wrap"><br>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <?php if (!empty($annnouncements)) { ?>
                        <?php foreach ($annnouncements as $key => $annnouncement) { ?>
                            <?php if ($this->Custom->canShow($annnouncement, $business)) { ?>
                                <!-- Owner Announcement -->
                                <div class="card pt-3 pl-3 pr-3 pb-0 mb-4">
                                    <?= $this->element('business_announcement', ['business' => $business, 'annnouncement' => $annnouncement]) ?>
                                </div>
                                <!-- End Owner Announcement -->
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <!-- Begin Special Offer -->
                    <?php if (!empty($offers)) { ?>
                        <?php foreach ($offers as $key => $offer) { ?>
                            <?php if ($this->Custom->canShow($offer, $business)) { ?>
                                <!-- Owner Special Offer -->
                                <div class="card pt-3 pl-3 pr-3 pb-0 mb-4">
                                    <?= $this->element('offers_block', ['business' => $business, 'offer' => $offer]) ?>
                                </div>
                                <!-- End Owner Special Offer -->
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <!-- End Special Offer -->


                    <!-- Business Highlights  -->
                    <div class="card p-4 mb-4">


                        <div class="row">
                            <div class="col-md-7 border-right">
                                <h5 class="bold mb-2">Ratings and reviews</h5>
                                <div class="customer-ratingbig mr-3"><!---<?= number_format(round($business->average_rating), 1) ?>---><i class="fas fa-star fa-lgmt-1 mb-1"></i></div>
                                <div class="mt-1 "><span class="h4 bold text-dark"><?= number_format(round($business->average_rating), 1) ?> out of 5 </span> <a class="badge p-1 badge-grey" href="#OVR"
   data-modal-target="#OVR">
Details

</a><br><small class="font-size-1"></small><?= $recommend_counts ?>&nbsp;out of&nbsp;<?= $review_counts ?> people recommended this business.</small></div>
                                <!-- End Header -->



<div class="mt-5">
<!-- Modal Window Trigger -->

<!-- End Modal Window Trigger -->

<!-- Overall Visitor Ratings Modal Window -->
<div id="OVR" class="js-modal-window u-modal-window" style="width: 450px;">
  <div class="card mt-5">
    <!-- Header -->
    <header class="bg-white mt-3 py-3 px-5">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="h4 bold mb-0"><i class="fas fa-star  mt-1 mb-1 text-primary"></i> <?= number_format(round($business->average_rating), 1) ?> out of 5 </h3>
        
        

        <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
          <span aria-hidden="true">×</span>
        </button>
      </div><div class="txt-14 mb-2">Based off the recommendation of <?= $recommend_counts ?> people.</div>
      
      
    <h3 class="h6 bold mt-3 mb-0">What goes into this rating?</h3>
<div class="txt-14 mb-2">This rating is based on how many people recommend or don't recommend the page.</div>  
      
      
    </header>
    <!-- End Header -->

    <!-- Body -->
    <div class="card-body pt-2 pb-5 pr-5 pl-5">   

 <h3 class="h6 bold mb-2">Overall Visitor Ratings</h3>


<div class="">
                                   
                                    <div class="row">
                                        <?php
                                        foreach ($overall_reviews as $key => $review) : ?>
                                            <div class="col-sm-6 mb-2 txt-14"><?= $review['option']->icon ?><?= $review['option']->name ?></div>
                                            <div class="col-sm-6">
                                                <div class="list-inline text-white star_size10 mb-1">
                                                    <?= $this->element('stars_count', ['rating' => $review['average']]) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="mt-3">
                                        <?php
                                        // for ($i = 0; $i < (count($reviews) > 1 ? 2 : count($reviews)); $i++) {

                                        ?>

                                        <!-- <p class="font-size-1"><q><?php //echo $reviews[$i]['recommend'] 
                                                                        ?></q></p> -->
                                        <!-- <p class="font-size-1"><q>Lorem Ipsum</q></p> -->
                                        <?php
                                        // }
                                        ?>

                                    </div>
                                </div>

                                <div class="mt-3">
                                    <hr>

                                    <div class="mt-3 font-size-1 text-center">
                                        <div class="font-size-1 bold mb-2">Do you recommend <?= ucfirst($business->name) ?>?</div>
                                       
                                         <span class="text-dark"><button type="button" style="width: 130px;" class="btn bold btn-light borderlt btn-xs mr-2 recommendYes">Yes</button></span>
                                       
                                        <span class="text-dark"><button type="button" class="btn bold btn-light borderlt btn-xs mr-2 recommendNo" style="width: 150px;">No</button></span>
                                    </div>

                                </div>
      </div>
    </div>
    <!-- End Body -->


    
</div>
<!-- End Overall Visitor Ratings Modal Window -->
              
        
</div>







<div class="border-top mt-5 pt-5">
                                   
                                    <div class="row">
                                        <?php
                                        foreach ($overall_reviews as $key => $review) : ?>
                                            <div class="col-sm-6 mb-2 txt-14"><?= $review['option']->icon ?><?= $review['option']->name ?></div>
                                            <div class="col-sm-6">
                                                <div class="list-inline text-white star_size10 mb-1">
                                                    <?= $this->element('stars_count', ['rating' => $review['average']]) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="mt-3">
                                        <?php
                                        // for ($i = 0; $i < (count($reviews) > 1 ? 2 : count($reviews)); $i++) {

                                        ?>

                                        <!-- <p class="font-size-1"><q><?php //echo $reviews[$i]['recommend'] 
                                                                        ?></q></p> -->
                                        <!-- <p class="font-size-1"><q>Lorem Ipsum</q></p> -->
                                        <?php
                                        // }
                                        ?>

                                    </div>
                                </div>

                                

                                    
                             

                                <div class="mt-3">
                                    <hr>

                                    <div class="mt-5 font-size-1 text-center">
                                        <div class="h6 bold mb-2">Do you recommend <?= ucfirst($business->name) ?>?</div>
                                        <!--<button type="button" style="width: 130px;" onClick="window.location.href='#recommendModal" data-modal-target="#recommendModal" class="btn btn-recommend btn-xs mr-2">Yes</button>-->
                                        <span class="text-dark"><button type="button" style="width: 150px;" class="btn btn-light borderlt  bold mr-2 recommendYes">Yes</button></span>
                                        <span class="text-dark"><button type="button" class="btn btn-light borderlt bold recommendNo" style="width: 150px;">No</button></span>
                                        <!-- <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'yes']]); ?>"><button type="button" style="width: 150px;" class="btn btn-light borderlt  bold mr-2">Yes</button></a>
                                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'no']]); ?>"><button type="button" class="btn btn-light borderlt bold " style="width: 150px;">No</button></a> -->
                                    </div>

                                </div>

                                <!-- End Rating -->
                            </div><!-- Location -->
                            <div class="col-md-5 ">
                                <h5 class="bold">Location and contact</h5>
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="357" height="155" id="gmap_canvas" src="https://maps.google.com/maps?q=<?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                    <style>
                                        .mapouter {
                                            position: relative;
                                            text-align: right;
                                        }

                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                        }
                                    </style>
                                </div>
                                <div class="txt-14 mt-3 mb-2">
                                    <span class="fas fa-map-marker-alt txt-14 mr-2"></span>
                                    <?= $business->address ?>,
                                    <?= $business->city->name ?>,
                                    <?= strtoupper($business->city->state->code) ?> -
                                    <?= $business->zip ?>
                                </div>
                                <div class="mb-2">
                                    <span class="fas fa-directions txt-14 mr-2"></span>
                                    <a class="txt-14" href="#getdirectionsModal" data-modal-target="#getdirectionsModal">Get Directions</a>
                                </div>

                                <div class="mb-2">
                                    <i class="fas fa-laptop txt-14 mr-2"></i>
                                    <a class="txt-14 mr-5" href="http://<?= $business->website ?>" target="_blank">Website</a>
                                </div>
                                <div class="mb-2">
                                    <span class="far fa-envelope txt-14 mr-2"></span>
                                    <a class="txt-14" href="mailto:<?= $business->email ?>?subject=Email from localinspire.com">Email</a>
                                </div>
                                <div class="mb-2 txt-14">

                                    <?php if (empty($business->business_hours)) : ?>
                                        <span class="far fa-clock mr-2"></span> Hours not available (<a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'edit', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>">Add hours</a>)
                                    <?php else : ?>
                                    
                                    
                                   

<div class="mt-1"><span class="far fa-clock mr-2"></span>
<!-- Modal Window Trigger -->
<a class="" href="#hours"
   data-modal-target="#hours">
 View Hours

</a>
<!-- End Modal Window Trigger -->

<!-- Hours Modal Window -->
<div id="hours" class="js-modal-window u-modal-window" style="width: 400px;">
  <div class="card mt-5">
    <!-- Header -->
    <header class="bg-white mt-5 py-3 px-5">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="h5 bold mb-0">Hours</h3>

        <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    </header>
    <!-- End Header -->

    <!-- Body -->
    <div class="card-body p-5">   <div class="">
                                   
                                    <div class="row">
                                        
                                        
                                        
                                    
                                        
                               
                                        
                                        
                                        
                                           <?php foreach ($business->business_hours as $bizHour) : ?> 
                                          
                                            
                                           <div class="container">
  <div class="row">
    <div style="max-width:120px" class="col-sm txt-17 text-dark">
       <?= $bizHour->day->name ?>
    </div>
    <div class="col-sm txt-17 text-dark">
      <?= $bizHour->opening_time ?>&nbsp;-&nbsp;<?= $bizHour->closing_time ?>
    </div>
   
  </div>
</div>  
                                            
                                             
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        <?php endforeach; ?>
                                        
                                        
                                        <div class="mt-5 ">
                                     <a class="mt-2 text-right" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'edit', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>">Add hours</a></div>
                                        
                                    </div>

                                   
                                </div>
      </div>
    </div>
    <!-- End Body -->
</div>
<!-- End Hours Modal Window -->
              
</div> 
 <?php endif; ?>
 
 
                                </div>
                            </div>
                        </div>
                        <!-- End Location -->
                    </div>
                    <!-- Get Directions Modal Window -->
                    <div id="getdirectionsModal" class="js-modal-window u-modal-window " style="width: 90%;position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;height: 90%!important;border-radius:0px!important;">
                        <div class="card">
                            <!-- Header -->
                            <header class="card-header bg-light py-3 px-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="h6 bold mb-0"><i class="fas fa-directions mr-1"></i> Get directions to <?= $business->name ?></h3>

                                    <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </header>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body p-0">
                                <div class="media">
                                    <div style="width:400px" class="mr-3">
                                        <div style="padding-left:10px;margin-top:0px">

                                            <div style="border-bottom: 1px solid #DEDEDE" class="col-sm-12">
                                                <div class="btn1-group">
                                                    <button class="btn1 btn1-default active" id="DRIVING" type="button"><img style="width:27px;height:28px" src="<?= $this->Url->build('/img/', ['fullBase' => true]); ?>car.png" alt=""></button>
                                                    <button class="btn1 btn1-default" id="TRANSIT" type="button"><img style="width:27px;height:28px" src="<?= $this->Url->build('/img/', ['fullBase' => true]); ?>train.png" alt=""></button>
                                                    <button class="btn1 btn1-default" id="WALKING" type="button"> <img style="width:27px;height:28px" src="<?= $this->Url->build('/img/', ['fullBase' => true]); ?>walking.png" alt=""></button>
                                                    <button class="btn1 btn1-default" id="BICYCLING" type="button"><img style="width:27px;height:28px" src="<?= $this->Url->build('/img/', ['fullBase' => true]); ?>biking.png" alt=""> </button>
                                                    <input type="hidden" id="mode" name="mode" value="DRIVING">
                                                </div>
                                            </div>
                                            <form role="form">
                                                <div>
                                                    <label class="small mt-5"><b>Start from</b></label>
                                                    <input type="text" style="background: url(<?= $this->Url->build('/img/', ['fullBase' => true]); ?>markerredlil.png) no-repeat scroll 7px 9px;padding-top:7px; padding-left:30px;" class="form-control" id="from" name="from" placeholder="Your starting address!">
                                                    <input type="hidden" id="cityLat" name="cityLat" />
                                                    <input type="hidden" id="cityLng" name="cityLng" />
                                                    <span class="help" id="frommsg1"></span>
                                                </div>
                                                <div style="float:left;margin-left:8px;margin-top:13px;margin-right:10px"><img src="<?= $this->Url->build('/img/', ['fullBase' => true]); ?>markerloc.png" alt=""></div>
                                                <div class="small" style="float:left;margin-top:10px;"><b><?= $business->name ?></b><br>
                                                    <?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?>
                                                </div>
                                                <br style="clear: left;" />
                                                <br>
                                                <div>
                                                    <button class="btn btn-primary" type="button" id="get_directionbutton">Get Directions</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        <div id="GMapCustomized-light" class="js-g-map embed-responsive embed-responsive-21by9 height-80vh"><iframe id="gmap_canvas" src="https://maps.google.com/maps?q=<?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Body -->


                        </div>
                    </div>
                    <!-- End Get Directions Modal Window -->
                    
                    
                    <div class="card p-4 mb-4">
                     <div class="row">
                            <div class="col-sm-12 font-size-1">
                                <h6 class="mb-2 h5 bold">About the Business</h6>
                                <span class="more">
                                    <?= nl2br($business->about) ?>
                                </span>
                            </div>
                    
                    </div>
                    </div>
                    
                    

                    <div class="card p-4 mb-4">
                        <div class="row">
                            <div class="col-sm-6 mb-4" style="border-bottom:1px solid #f1f1f1">
                                <h5 class="bold">Business Amenities</h5>
                            </div>
                            <div class="col-sm-6 mb-4 text-right" style="border-bottom:1px solid #f1f1f1"><a class="small bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'edit', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>">Improve this listing</a> <?php if (empty($business->user)) { ?>| <a class="small bold" href="#">Manage this business?</a><?php } ?></div>
                        </div>
                        <style>
                            .morecontent span {
                                display: none;
                            }

                            .morelink {
                                display: block;
                            }
                        </style>
                        <div class="row">
                            
                            <!---<div class="col-sm-4 font-size-1" style="border-right:1px solid #f1f1f1">
                                <h6 class="mb-1 font-size-1 bold">About</h6>
                                <span class="more">
                                    <?= nl2br($business->about) ?>
                                </span>
                            </div>--->
                            
                            <?php if (!empty($filters)) : ?>
                                <?php $filterChunks = array_chunk($filters, $chunkSize, true); ?>
                                <div class="col-sm-6 font-size-1" style="border-right:1px solid #f1f1f1">
                                    <?php if (!empty($filterChunks[0])) : ?>
                                        <?php foreach ($filterChunks[0] as $key => $filter) : ?>
                                            <?= $this->element('business_view_filter', ['key' => $key, 'filter' => $filter]) ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6 font-size-1">
                                    <?php if (!empty($filterChunks[1])) : ?>
                                        <?php foreach ($filterChunks[1] as $key => $filter) : ?>
                                            <?= $this->element('business_view_filter', ['key' => $key, 'filter' => $filter]) ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                    <input type="hidden" value="1" id="review_page_number" />
                    <input type="hidden" value="1" id="question_page_number" />
                    <input type="hidden" value="1" id="advice_page_number" />
                    <!-- Reviews and Recommendations -->
                    <!-- Features Section -->
                    <div>
                        <!-- Nav Classic -->
                        <div class="card position-relative text-center z-index-2 mx-lg-auto">
                            <ul class="nav nav-classic nav-rounded  nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-medium active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="material-icons fa-2x">rate_review</i>
                                        </div>
                                        <div class="h6 bold mt-2"><span id="review_counts"><?= $review_counts ?></span>&nbsp;Reviews</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-medium " id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="material-icons fa-2x">question_answer</i>
                                        </div>
                                        <div class="h6 bold mt-2 ">
                                            <span class="question_counts"><?= $question_counts ?></span>&nbsp;
                                            Q&A
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-medium" id="pills-three-tab" data-toggle="pill" href="#pills-three" role="tab" aria-controls="pills-three" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fas fa-lightbulb fa-2x"></i>

                                        </div>
                                        <div class="h6 bold mt-2"><span id="advice_counts"><?= $advice_counts ?></span>&nbsp;Advice/Tips</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-1 show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
                                <!-- Mockup Block -->
                                <div class="row justify-content-lg-between align-items-lg-center">
                                    <div class="col-lg-12">

                                        <!-- Special Offer -->
                                        <div class="card mt-3  pl-4 pr-4 mb-4">
                                            <div class="row mb-0">
                                                <div class="col-9">

                                                    <h4 class="text-gray bold mb-0 pt-4">Reviews</h4>

                                                </div>
                                                <div class="col-lg-3">
                                                    
                                                    
                                                     <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>" class="btn btn-primary bold btn-sm  mt-3">Write a review
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>


                                            <div class="booking-checkbox_wrap mb-3 mt-3 small review_filter">

                                                <div class="bold mb-3">Filter for better results</div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline1" name="review_filter" class="custom-control-input" value="5">
                                                    <label class="custom-control-label" for="customCheckboxInline1">Excellent</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline2" name="review_filter" class="custom-control-input" value="4">
                                                    <label class="custom-control-label" for="customCheckboxInline2">Very Good</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline3" name="review_filter" class="custom-control-input" value="3">
                                                    <label class="custom-control-label" for="customCheckboxInline3">Average</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline4" name="review_filter" class="custom-control-input" value="2">
                                                    <label class="custom-control-label" for="customCheckboxInline4">Poor</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline5" name="review_filter" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="customCheckboxInline5">Terrible</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline7" name="review_filter" class="custom-control-input" value="r">
                                                    <label class="custom-control-label" for="customCheckboxInline7">Recommends</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="customCheckboxInline8" name="review_filter" class="custom-control-input" value="h">
                                                    <label class="custom-control-label" for="customCheckboxInline8">Helpful</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="reviews_for_business">
                                            <?= $this->element('business_reviews') ?>
                                        </div>

                                    </div>

                                </div>
                                <!-- End Mockup Block -->
                            </div>
                            <div class="tab-pane fade pt-3 " id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                                <!-- Mockup Block -->
                                <div class="card p-3 px-2 mb-4">
                                    <div class="row">
                                        <div class="col-lg-8 pt-2">

                                            <h4 class="text-gray bold mb-0">Questions & Answers</h4>
                                            <a class="small " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'questions', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">See all <span class="question_counts"><?= $question_counts ?></span> questions</a>
                                        </div>
                                        <div class="col-lg-4 pt-2" style="text-align: right;">
                                            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary bold btn-sm">Ask a Question
                                            </a>
                                        </div>


                                        <div class="collapse" id="collapseExample">
                                            <div class="">
                                                <div class="card-body">
                                                    <div class="p-3">
                                                        <h6><b>Got Questions?</b> Get answers from <strong><?= $business->name ?></strong> staff and past visitors. </h6>
                                                        <form id="postquestionform" class="js-validate" method="POST" action="">

                                                            <div class="form-group">
                                                                <div class="js-form-message">
                                                                    <div class="input-group">
                                                                        <img class="after_login_img  u-sidebar--account__toggle-img mr-2" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                                                        <textarea class="form-control" rows="3" name="question" placeholder="Hi, <?php if (!empty($currentUser)) {
                                                                                                                                                        echo $currentUser->firstname . ", ";
                                                                                                                                                    } ?>what would you like to know about <?= $business->name ?>?" aria-label="<b>What would you like to know about <?= $business->name ?>?</b>" required="" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> You must ask a question about <?= $business->name ?> to submit.</div>" data-error-class="u-has-error" data-success-class="u-has-success" required></textarea>

                                                                    </div>
                                                                    <!-- End Input -->
                                                                </div>
                                                                <small>Note: your question will be posted publicly here and on the Questions & Answers page. </small>
                                                                <a class="btn btn-sm btn-link" href="#questionModal" data-modal-target="#questionModal">
                                                                    <i data-toggle="tooltip" data-placement="top" title="Question Guidelines" class="fas fa-info-circle"></i>
                                                                </a>
                                                                <input type="hidden" name="business_id" value="<?= $business->id ?>" />
                                                                <div class="pl-4 small mb-2">
                                                                    <input type="checkbox" class="form-check-input" value="1" name="notify" id="notify" checked>
                                                                    Get notified about new answers to your questions.
                                                                </div>
                                                                <button type="submit" class="btn btn-sm btn-primary bold text-right" id="questionsformsubmit">Post Question</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Basics Accordion -->
                                        <div id="basicsAccordion">
                                            <!-- Card -->
                                            <div>

                                                <div id="basicsCollapseTwo" class="collapse" aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion">
                                                    <div class="card-body">
                                                        <div class="p-3">
                                                            <h6><b>Got Questions?</b> Get answers from <strong><?= $business->name ?></strong> staff and past visitors. </h6>

                                                            <div class="form-group">
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Hi, what would you like to know about <?= $business->name ?>?" rows="3"></textarea>
                                                                <small>Note: your question will be posted publicly here and on the Questions & Answers page. </small>
                                                                <a class="btn btn-sm btn-link" href="#questionModal" data-modal-target="#questionModal">
                                                                    <i data-toggle="tooltip" data-placement="top" title="Question Guidelines" class="fas fa-info-circle"></i>
                                                                </a>

                                                                <div class="pl-4 small mb-2"> <input type="checkbox" class="form-check-input" value="1" name="notify" id="notify">
                                                                    Get notified about new answers to your questions.
                                                                </div>
                                                                <button type="submit" class="btn btn-primary text-right" id="questionsformsubmit">Post Question</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                    </div>
                                </div>
                                <div id="qa_for_business">
                                    <?= $this->element('business_questions') ?>
                                </div>

                                <!-- End Mockup Block -->
                            </div>
                            <div class="tab-pane fade pt-0" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">

                                <!-- Mockup Block -->
                                <div class="row justify-content-lg-between align-items-lg-center">
                                    <div class="col-lg-12">

                                        <!-- Special Offer -->
                                        <div class="card mt-3  pl-4 pr-4 mb-4">
                                            <div class="row mb-0">
                                                <div class="col-9">

                                                    <h4 class="text-gray bold mb-0 pt-2">Tips/Advice</h4>

                                                </div>
                                                <div class="col-lg-3 mb-2">
                                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>" class="btn btn-primary bold btn-sm borderlt mt-2">Write a review
                                                    </a></div>



                                            </div>
                                        </div>

                                        <div id="tips_for_business">
                                            <?= $this->element('business_reviews', ['tips' => true]) ?>
                                        </div>

                                    </div>

                                </div>
                                <!-- End Mockup Block -->
                                <!-- End Mockup Block -->
                            </div>
                        </div>
                        <!-- End Tab Content -->
                    </div>
                  <!-- Featured Ads -->
<?php //if (!empty($featured_ads) ) { ?>
<?php if (!empty($featured_ads) and !$business->enhanced) { ?>
    <section class="gray-dark mb-4">
        <input type="hidden" id="business" value="<?= $business->id ?>" />
        <!--//END BOOKING DETAILS -->
        <div class="gray-dark border-bottom">
            <div class="card container"><div class="mt-3">
  
  <div class="row">
    
    <div class="col-md-9">
       <h4 class="h5 font-weight-bold">Other Businesses To Consider
</h4>
    </div>
    <div class="col col-lg-3">
        <div class="txt-15 mb-5 text-secondary text-right">Sponsored links &nbsp;&nbsp;<span data-toggle="popover" data-html="true" data-placement="top" data-trigger="hover" data-content="<span class='small'>Business owners paid for these ads. For more information visit our business center.</span>"><i class="fa fa-info-circle" aria-hidden="true"></i></span></div>
    </div>
  </div>
</div>
               
                


                <div class="card-body mb-md-0">
                <!-- <div class="card-body pt-4 pb-5 px-5 mb-3 mb-md-0"> -->
                <!-- <div class="card-body"> -->
                    <div class="row">
                        <?= $this->element('ads_featured', ['featured_ads' => $featured_ads, 'class_to_use' => 'col-md-3']) ?>
                    </div>
                </div>

                <!-- <div class="card-deck card-sm-gutters-2 d-block d-sm-flex">
                    <div class="row">
                        <?php //echo $this->element('ads_featured', ['featured_ads' => $featured_ads]) 
                        ?>
                    </div>
                </div> -->
                


            </div>
    </section>
<?php } ?>  <!-- End Features Section -->
                    
                </div>


                <!-- Right SIdebar -->
                <div class="col-md-4 responsive-wrap">
                    <!-- Get Updated
					<div class="card p-3">
						<h5>Get Updated!</h5>
						<p class="small">Get updates, specials and more by saving this business to one of your lists...</p>

						<div class="mt-2">
							<button type="button" class="btn btn-block btn-recommend biz_save"><i class="far fa-bookmark mr-2"></i> <span class="small">Save to a list</span></button>
						</div>
						<div class="text-center small mt-2">12 travelers saved this place</div>


					</div>  End Get Updated -->
                    <?php if (!empty($business->cta) and ($business->enhanced or $business->sponsored)) { ?>
                        <!-- Deal -->
                        <div class="card pt-3 pb-3 mb-4 mt-4 px-3">
                            <div class="media mr-2 mb-3">
                                <i style="font-size:19px;color:#555" class="fa fa-bullhorn mr-2"></i>
                                <div class="media-body align-self-center">
                                    <span class="d-block bold mb-0"><?= $business->cta->text ?></span>
                                </div>
                            </div>
                            <a href="<?= $business->cta->link ?>" target="_blank" class="btn btn-block btn-sm bold btn-cta"><?= $business->cta->btn_text ?></a>
                        </div>
                        <!-- End Deal-->
                    <?php } ?>

                    <!-- Deal 
					<div class="card pt-3 mb-4 mt-4 px-3">
						<div class="media mr-2 mb-3">
							<i style="font-size:19px;color:#555" class="fas fa-tag mr-2"></i>
							<div class="media-body align-self-center">
								<span class="d-block bold mb-0">$100 for $150 Deal at Panda Express Restaurant and Take Out...</span>
								<a href="" class="">$100 Buy now</a>
							</div>
						</div>
					</div>
                 End Deal-->
                    <?php if (!empty($relatedBusinesses)) { ?>
                        <!-- Might Like -->
                        <h6 class="mt-4 mb-1 bold">You might also like</h6>
                        <?php foreach ($relatedBusinesses as $biz) { ?>
                            <div class="d-flex pl-2 mt-1 mb-2">
                                <img class="u-avatar square-img55 align-self-center mr-3" src="<?= $this->Custom->getBusinessPhotoUrl($biz) ?>" alt="<?= $biz->name ?>">
                                <div>
                                    <a class="font-size-12 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($biz->name)), strtolower($biz->city->name), $biz->city->state->code, $biz->id]); ?>"><?= $biz->name ?></a>
                                    <ul class="list-inline text-white star_size11 mb-2">
                                        <?= $this->element('stars_count', ['rating' => $biz->average_rating]) ?>
                                        <span class="small text-secondary"> &nbsp;&nbsp;<span class="txt-12"><?= $biz->review_count ?>&nbsp; review<?= $biz->review_count > 1 ? "s" : "" ?></span></span>
                                    </ul>
                                    <small class="d-block text-graylt star_size12"><?= $this->Custom->displayCategoriesAndSubcategories($biz, false) ?></small>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="text-center">
                        <hr>
                    </div>
                    <!-- Icon Blocks -->
                    <div class="text-center px-5">
                        <!-- Basic Articles -->

                      <?php if (empty($business->user)) { ?>   <figure id="SVGcreateAccount" class="svg-preloader w-75 mx-auto mb-4">
                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/create-account.svg" alt="Image Description" data-parent="#SVGcreateAccount">
                        </figure>

                        <!-- Info -->
                        <div class="mb-4">
                            <h3 class="h5 bold">Is this your business?</h3>
                            <p class="mb-md-0">Make sure your information is up to date. Plus use our free tools to find new customers and more!</p>
                        </div>
                        <!-- End Info -->

                        <!-- <a class="btn btn-sm btn-soft-primary btn-pill transition-3d-hover claim_business" href="">
                            Claim it now
                            <span class="fas fa-angle-right ml-2"></span>
                        </a> -->

                       
                            <a class="btn btn-sm btn-soft-primary btn-pill transition-3d-hover" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'claim', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">
                                Claim it now
                                <span class="fas fa-angle-right ml-2"></span>
                            </a>
                        <?php } ?>

                    </div>
                    <!-- End Icon Blocks -->
                </div>
            </div>
        </div>
    </section>
</div>





<!-- Share Business Modal Window -->
<?= $this->element('share_business_modal', ['business' => $business]) ?>
<!-- End Share Business Modal Window -->


<!-- Question Guidelines Modal Window -->
<?= $this->element('question_modal') ?>
<!-- End Question Guidelines Modal Window -->

<!-- Report Owner Modal Window -->
<?= $this->element('report_owner_modal') ?>
<!-- End Report Owner Modal Window -->

<!-- Share Review Modal Window -->
<?= $this->element('share_review_modal') ?>
<!-- End Share Review Modal Window -->

<!-- Report Review Modal Window -->
<?= $this->element('report_review_modal') ?>
<!-- End Report Review Modal Window -->


<!-- Report Question Modal Window -->
<?= $this->element('report_question_modal') ?>
<!-- End Report Question Modal Window -->


<!-- Report Photos Modal Window -->
<?= $this->element('report_photo_modal') ?>
<!-- End Report Photos Modal Window -->

<!-- Report Answer Modal Window -->
<?= $this->element('report_answer_modal') ?>
<!-- End Report Answer Modal Window -->


<!-- Report Success Modal Window -->
<?= $this->element("success_modal") ?>
<?= $this->element("answer_success_modal") ?>

<!-- Post Question Success Modal Window -->
<?= $this->element("success_modal_question") ?>

<?= $this->element('claim_business_modal') ?>

<script>
    $().popover({
        container: 'body'
    })
    $(document).ready(function() {
        $("[rel='tooltip']").tooltip();

        $('.thumbnail').hover(
            function() {
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function() {
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
        );

        // load_review_for_business(current_page, false);
        //load_question_answer(q_current_page, false);
        //load_tips(a_current_page, false);


        $('.review_filter input[type=checkbox]').change(function() {
            // console.log()
            review_filter = $('.review_filter input:checked').map(function(i, e) {
                return e.value
            }).toArray();
            // current_page = 1;
            // load_review_for_business(current_page);
            // console.log(review_filter);

            var review_block = $('#reviews_for_business')
            getBusinessReviews(review_block, $(this));
        })


        jQuery(document).on('click', '.tipslink', function(e) {
            // $('.page-link').click(function(e) {
            e.preventDefault();
            var review_block = $('#tips_for_business')
            getBusinessReviews(review_block, $(this), true);

        });

        jQuery(document).on('click', '.reviewpagelink', function(e) {
            // $('.page-link').click(function(e) {
            e.preventDefault();
            var review_block = $('#reviews_for_business')
            getBusinessReviews(review_block, $(this));

        });

        jQuery(document).on('click', '.questionpagelink', function(e) {
            // $('.page-link').click(function(e) {
            e.preventDefault();
            // var block = $('#qa_for_business')
            // getQuestions(block, $(this));
            getQuestions($(this));

        });

        var business = '<?= $this->Custom->getVarJson($business) ?>';

        var business_id = parseInt("<?php echo $business->id; ?>");

    });
</script>