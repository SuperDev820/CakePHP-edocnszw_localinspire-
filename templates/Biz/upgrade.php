<style>
  .tooltip-inner {
    padding: 9px !important;
    max-width: 450px;
    /* set this to your maximum fitting width */
    width: inherit;
    /* will take up least amount of space */
  }
</style>
<!-- Content Section -->
<div class="bg-light">
  <main>
    <div class="container space-2">

      <!-- Pricing Section -->
      <div class="container">
        <?= $this->element('upgrade_block', ['business' => $active_business, 'claim' => true]) ?>
      </div>
      <!-- End Pricing Section -->

      <!-- Pricing Section -->
      <div class="d-none dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll bg-light" data-options='{direction: "normal"}'>
        <!-- Apply your Parallax background image here -->
        <div class="dzsparallaxer--target" style="height: 120%; background-image: url(<?= $this->Url->build('/svg/bg-elements-7.svg', ['fullBase' => true]); ?>);"></div>

        <div class="container space-2">
          <!-- Card Group -->
          <div class="card-group card-group-md-break rounded shadow-soft">
            <div class="card">
              <div class="card-body text-center pt-9 px-7">
                <!-- Button Group -->
                <div class="btn-group btn-group-toggle mb-7">
                  <a class="js-animation-link btn btn-sm btn-outline-secondary btn-custom-toggle-primary btn-pill active" href="javascript:;" data-target="#pricingMonthly" data-link-group="idPricing">Monthly</a>
                  <a class="js-animation-link btn btn-sm btn-outline-secondary btn-custom-toggle-primary btn-pill" href="javascript:;" data-target="#pricingYearly" data-link-group="idPricing">
                    Yearly
                    <span class="badge badge-success badge-pill badge-pos">Save <?= $this->Custom->savePercentage($packages[2]) ?>%</span>
                  </a>
                </div>
                <!-- End Button Group -->

                <!-- Monthly Plans -->
                <div id="pricingMonthly" data-target-group="idPricing">
                  <!-- Range Slider -->
                  <div class="text-primary font-weight-semi-bold h3 mb-4">

                    <span class="ml-n2"><?= $packages[2]->name ?></span>
                  </div>
                  <div class="display-4 text-primary font-weight-semi-bold mb-5">
                    <span>$</span> <span class="ml-n2"><?= number_format($packages[2]->price_per_month, 2) ?></span>
                  </div>
                  <button type="button" data-business_id="<?= $active_business->id ?>" data-package_id="<?= $packages[2]->id ?>" data-duration="monthly" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe"><?= (!empty($active_business->current_subscription) and $active_business->current_subscription->package_id > $packages[2]->id) ? "Downgrade to " : ((!empty($active_business->current_subscription) and $active_business->current_subscription->package_id == $packages[2]->id) ? "Get " : "Upgrade to ") ?> <?= $packages[2]->name ?></button>
                </div>
                <!-- End Monthly Plans -->

                <!-- Yearly Plans -->
                <div id="pricingYearly" style="display: none; opacity: 0;" data-target-group="idPricing">
                  <!-- Range Slider -->
                  <div class="text-primary font-weight-semi-bold h3 mb-4">

                    <span class="ml-n2"><?= $packages[2]->name ?></span>
                  </div>
                  <div class="display-4 text-primary font-weight-semi-bold mb-5">
                    <span>$</span>
                    <span class="ml-n2"><?= number_format($packages[2]->price_per_year, 2) ?></span>
                  </div>
                  <button type="button" data-business_id="<?= $active_business->id ?>" data-package_id="<?= $packages[2]->id ?>" data-duration="yearly" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe"><?= (!empty($active_business->current_subscription) and $active_business->current_subscription->package_id > $packages[2]->id) ? "Downgrade to " : ((!empty($active_business->current_subscription) and $active_business->current_subscription->package_id == $packages[2]->id) ? "Get " : "Upgrade to ") ?> <?= $packages[2]->name ?></button>
                </div>
                <!-- End Yearly Plans -->
              </div>
              <div class="card-footer border-0 pt-0 pb-9 px-7">
                <!-- Icon Blocks -->
                <div class="media align-items-center">
                  <figure id="icon13" class="svg-preloader ie-height-56 w-100 max-width-8 mr-4">
                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>icon-13.svg" alt="SVG" data-parent="#icon13">
                  </figure>
                  <div class="media-body">
                    <h4 class="h6 mb-1">Enhance your business profile</h4>
                    <p class="small mb-0">See an increase in business and repeat visitors by choosing the <b>Enhanced Business Profile.</b></p>
                  </div>
                </div>
                <!-- End Icon Blocks -->
              </div>
            </div>

            <div class="card">
              <div class="card-body ">
                <div class="pl-lg-6 mt-2">
                  <div class="row">
                    <div class="col-sm-6 mb-5">
                      <!-- Icon Blocks -->
                      <figure class="ie-height-40 w-100 max-width-6 mb-3">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>icon-29.svg" alt="SVG" data-parent="#pricingSection">
                      </figure>
                      <h4 class="h5">Remove competitor's ads</h4>
                      <p>Remove competitor's ads from your business listings page.</p>
                      <!-- End Icon Blocks -->
                    </div>
                    <div class="col-sm-6 mb-5">
                      <!-- Icon Blocks -->
                      <figure class="ie-height-40 w-100 max-width-6 mb-3">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>icon-40.svg" alt="SVG" data-parent="#pricingSection">
                      </figure>
                      <h4 class="h5">Respond to reviews</h4>
                      <p>Respond to your csutomers reviews and thank them.</p>
                      <!-- End Icon Blocks -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6 mb-5">
                      <!-- Icon Blocks -->
                      <figure class="ie-height-40 w-100 max-width-6 mb-3">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>icon-4.svg" alt="SVG" data-parent="#pricingSection">
                      </figure>
                      <h4 class="h5">Private message reviewer</h4>
                      <p>Private message and thank your customers who leave you a review.</p>
                      <!-- End Icon Blocks -->
                    </div>
                    <div class="col-sm-6 mb-5">
                      <!-- Icon Blocks -->
                      <span class="text-primary mr-3">
                        <span class="fas fa-images text-primary mt-3 font24"></span>
                      </span>
                      <h4 class="h5 mt-3">Photo slideshow</h4>
                      <p>You decide the order of your business photos on your business page. (up to 10 photos)</p>
                      <!-- End Icon Blocks -->
                    </div>
                  </div>

                  <div class="row mb-0">
                    <div class="col-sm-6 mb-5">
                      <!-- Icon Blocks -->
                      <span class="text-primary mr-3">
                        <span class="fas fa-bullhorn text-primary mt-3 font24"></span>
                      </span>
                      <h4 class="h5 mt-3">Announcements</h4>
                      <p>Let your visitors and customers know what you're up to with Announcements.</p>
                      <!-- End Icon Blocks -->
                    </div>
                    <div class="col-sm-6">
                      <!-- Icon Blocks -->
                      <figure class="ie-height-40 w-100 max-width-6 mb-3">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>icon-31.svg" alt="SVG" data-parent="#pricingSection">
                      </figure>
                      <h4 class="h5">Call to Action</h4>
                      <p>Get more leads with an enticing Call to Action button.</p>
                      <!-- End Icon Blocks -->
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- End Card Group -->
          </div>
        </div>
        <!-- End Pricing Section -->


        <div class="row">
          <div class="col-lg-3 mb-9 mb-lg-0">
            <?= $this->element('bizsidebar'); ?>
          </div>
          <div class="col-lg-9 mb-9 mb-lg-0">
            <div class="card p-4">


              <h4 class="bold">Upgrade your business</h4>
              <div class="infobox mb-4">Attract more customers with our upgraded features.</div>



              <div class="row">

                <div class="col-md-1"><img class="square-img45" src="https://li.localinspire.com/upload/5b642ff30be2d_profile.jpg"></div>
                <div class="col-md-9"> <span class="bold font18 mb-10">Enhance your business profile</span> <br>
                  <span style="font-size:13px;color:#aaaaaa">$50 per month </span></div>


                <div class="col-md-2">
                  <span data-toggle="modal" data-target="#getcode"><button onclick="location.href='package_name.php';" data-original-title="Add this package!" data-toggle="tooltip" class="btn btn-defaultgradxxsm " type="button">Add</button></span>
                </div>

                <div class="col-md-12 mt-3 txt-14">See an increase in business and repeat visitors by choosing the <b>Enhanced Business Profile.</b>

                  <ul class="mt-2">
                    <li>Remove competitor's ads from your business listings page.</li>
                    <li>You decide the order of your business photos on your business page. <span class="txt-12lt text-secondary">(up to 10 photos)</span></li>
                    <li>Get more leads with an enticing <b>Call to Action</b> button.</li>
                    <li>Let your visitors and customers know what you're up to with <b>Announcements</b>.</li>
                    <li>Provide your visitors and customers with <b>Special deals</b> deals.</li>
                  </ul>
                  <!-- Icon Blocks -->
                  <div class="container mt-4 text-center">
                    <div class="row">
                      <div class="col-md-2 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3">
                          <span class="btn btn-icon btn-soft-primary rounded-circle mr-3">
                            <span class="fas fa-ban btn-icon__inner"></span>
                          </span>
                        </div>Remove competitor's ads
                        <!-- End Contacts -->
                      </div>

                      <div class="col-md-1 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3 font24">
                          +
                        </div>
                        <!-- End Contacts -->
                      </div>
                      <div class="col-md-2 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3">
                          <span class="btn btn-icon btn-soft-primary rounded-circle mr-3">
                            <span class="fas fa-images btn-icon__inner"></span>
                          </span>
                        </div>Photo selection
                        <!-- End Contacts -->
                      </div>

                      <div class="col-md-1 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3 font24">
                          +
                        </div>
                        <!-- End Contacts -->
                      </div>


                      <div class="col-md-2 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3">
                          <span class="btn btn-icon btn-soft-primary rounded-circle mr-3">
                            <span class="fas fa-bullhorn btn-icon__inner"></span>
                          </span>
                        </div>Call to Action
                        <!-- End Contacts -->
                      </div>
                      <div class="col-md-1 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3 font24">
                          +
                        </div>
                        <!-- End Contacts -->
                      </div>


                      <div class="col-md-2 mb-7 mb-md-0 text-center">
                        <!-- Contacts -->
                        <div class="mb-3">
                          <span class="btn btn-icon btn-soft-primary rounded-circle mr-3">
                            <span class="fas fa-scroll btn-icon__inner"></span>
                          </span>
                        </div>Announcements
                        <!-- End Contacts -->
                      </div>
                    </div>
                  </div>
                  <!-- End Icon Blocks -->
                </div>

              </div>



              <hr class="mt-3 mb-3">



              <div class="row mt-3">

                <div class="col-md-1"><img class="square-img45" src="https://li.localinspire.com/upload/5b642ff30be2d_profile.jpg"></div>
                <div class="col-md-9"> <span class="bold font18 mb-10">Localinspire Ads</span> <span class="txt-12lt">(Feature your business across site)</span><br>
                  <span style="font-size:13px;color:#aaaaaa">$50 per month </span></div>


                <div class="col-md-2">
                  <span data-toggle="modal" data-target="#getcode"><button onclick="location.href='package_name.php';" data-original-title="Add this package!" data-toggle="tooltip" class="btn btn-defaultgradxxsm " type="button">Add</button></span>
                </div>





                <div style="padding-top:10px;padding-left:8px;padding-bottom:10px;font-size:14px;" class="col-md-12">Keep your customers in fromnt of your site by featuring your business accross the site in your city, remove competitors ads from your listing. <a href="package_name.php" style="font-size:17px;font-weight:bold;margin-bottom:15px">Learn more</a></div>

              </div>



              <hr>


              <div class="row">

                <div class="col-md-1"><img class="square-img45" src="https://li.localinspire.com/upload/5b642ff30be2d_profile.jpg"></div>
                <div class="col-md-9"> <span style="font-size:17px;font-weight:bold;margin-bottom:15px">Add Deals to Your Page</span><br>
                  <span class="txt-12lt text-graylt">$50 per month </span></div>


                <div class="col-md-2">
                  <span data-toggle="modal" data-target="#getcode"><button onclick="location.href='package_name.php';" data-original-title="Add this package!" data-toggle="tooltip" class="btn btn-defaultgradxxsm " type="button">Add</button></span>
                </div>





                <div style="padding-top:10px;padding-left:8px;padding-bottom:10px;font-size:14px;" class="col-md-12">Allow your visitors to purchase specials and deals at a discount from your listings page, get repeat customers, and help with slow times by adding deals. <a href="package_name.php" style="font-size:17px;font-weight:bold;margin-bottom:15px">Learn more</a></div>

              </div>


            </div>
          </div>
          <BR>

        </div>


      </div>
  </main>
</div>
<!-- End Content -->