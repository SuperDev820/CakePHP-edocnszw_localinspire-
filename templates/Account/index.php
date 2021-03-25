<?php $this->assign('title', 'User Dashboard'); ?>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>


            <div class="card p-5">


                <p class="bold"> Welcome to localinspire!</p>

                <!--- Birthday Section -----
      
      
      
                       <div class="row">
                  <div class="col-md-3"><a href="<?php //echo ROOT; 
                                                    ?>/account/specials"><img style="width:180px;height:180px;"  src="https://li.localinspire.com/account/happy-birthday.jpg"></a> </div>
                  <div class="col-md-9"><h3 class="bold">We want to wish you a happy birthday!</h3>Some businesses give specials for their customers on their birthdays! <a href="/account/specials">Click here</a> to check and see if there are any specials for you to take advantage of. <br><br><div class="card p-2">Let your favorite business know about this and see if they are willing to give their customers specials.</div></div></div>
                  
                  --->

                <!-- Icon Blocks -->
                <div class="container mt-8">
                    <div class="row">
                        <div class="col-md-4 mb-9  mb-md-0">
                            <div class="pr-lg-4">
                                <figure id="SVGanalysis" class="svg-preloader mb-3 ie-analysis">
                                    <img class="js-svg-injector w-75" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/analysis.svg" alt="Image Description" data-parent="#SVGanalysis">
                                </figure>
                                <h4 class="h5">Refer friends</h4>
                                <p>Invite your friends to join to share your reviews and recommendations with them.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-9 mb-md-0">
                            <div class="pr-lg-4">
                                <figure id="SVGinTheOffice" class="svg-preloader mb-3 ie-in-the-office">
                                    <img class="js-svg-injector w-75" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/in-the-office.svg" alt="Image Description" data-parent="#SVGinTheOffice">
                                </figure>
                                <h4 class="h5">Find & review</h4>
                                <p>Find business that you have visited to submit a review or recommendation.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pr-lg-4">
                                <figure id="SVGmakeItRain" class="svg-preloader mb-3 ie-make-it-rain">
                                    <img class="js-svg-injector w-75" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/make-it-rain.svg" alt="Image Description" data-parent="#SVGmakeItRain">
                                </figure>
                                <h4 class="h5">Get special</h4>
                                <p>Start looking for businesses that offer specials and discounts.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Icon Blocks -->

                <hr>

                <!-- Indicator -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <?= $this->element('activity_feed') ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <?= $this->element('announcement_feed') ?>
                    </div>
                </div>
                <!-- End Indicator -->
                <?php if (!empty($featured_ads)) { ?>
                    <!-- End Card -->
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body pt-4 pb-5 px-5 mb-3 mb-md-0">

                                   <div class="customer-ratingbig mr-3"><i class="fas fa-ad "></i></div> <h3 class="h6 font-weight-semi-bold">Sponsored Businesses in your city. <span style="float:right;font-size: .7em;"></span></h3>
                                    <hr class="mt-3 mb-5">

                                    <div class="row">
                                        <?= $this->element('ads_featured', ['featured_ads' => $featured_ads, 'class_to_use' => 'col-md-4']) ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- End Content Section -->
    </main>
    <!-- ========== END MAIN ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->


    <!-- Request Payment Modal Window -->
    <?= $this->element('request_payment_modal') ?>
    <!-- End Request Payment Modal Window -->

</div>