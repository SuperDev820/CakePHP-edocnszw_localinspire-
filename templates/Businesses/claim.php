
<div class="bg-light">
  <!-- ========== MAIN ========== -->
  <main id="content" role="main">
    <!-- Hero Section -->
    <div class="container space-2">
      <h3 class="bold text-primary">Grow your business with free tools from Localinspire</h3>
      <div class="row justify-content-lg-between align-items-lg-center">
        <div class="col-lg-7 mb-4">
          <!-- Title -->
          <div class="mb-3">

            <h2 class="text-dark h3 font-weight-semi-bold"><?= $business->name ?></h2>
            <h1 class="h4 mb-0"><?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?> </span></h1>
          </div>
          <p><b>Claim your free listing</b> – and start building your business with Localinspire.. Attract more visitors, and win more business.</p>
          <!-- End Title -->

          <a href="" class="claim_business btn btn-primary btn-wide bold">Claim your free listing</a>

        </div>

        <div class="col-lg-5 mb-4">
          <!-- SVG Icon -->
          <div class=" d-none d-lg-block">
            <!-- SVG Icon -->
            <figure id="SVGinnovation" class="svg-preloader w-100 mr-4 mb-4 mb-sm-0">
              <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/innovation.svg" alt="Image Description" data-parent="#SVGinnovation">
            </figure>
            <!-- End SVG Icon -->
          </div>
          <!-- End SVG Icon -->
        </div>
      </div>


      <!-- End Hero Section -->
      <!-- Video Section -->
      <div class="bg-white border-top">
        <div class="container">
          <!-- Title -->
          <div class="mb-9">


            <div class="w-md-80 w-lg-50 mt-4 text-center mx-md-auto mb-9">

              <h2 class="font-weight-normal">Take control of your listing</h2>
              <p class="mb-0">How would you like to grow your business and get<br> more customers for <b><?= $business->name ?></b>?</p>
            </div>



            <!-- LocalNavi for -->
            <div class="container space-bottom-2">
              <div class="row align-items-lg-center">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                  <!-- Info -->
                  <div class="pl-lg-7">
                    <div class="mb-4">
                      <h3 class="h4">Take control of your listing</h3>
                      <p>Customize your business listing details, set main photo, upload photos, and more to show your customers what you're all about.</p>
                    </div>

                    <!-- Link -->
                    <a class="card border-0 shadow-sm claim_business" href="">
                      <div class="card-body p-4">
                        <div class="media align-items-center">
                          <div class="u-avatar mr-3">
                            <figure class="ie-height-56 max-width-8 mx-auto">
                              <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-29.svg" alt="SVG" data-parent="#icon29">
                            </figure>
                          </div>
                          <span class="media-body">
                            <span class="d-flex justify-content-between align-items-center font-weight-semi-bold">
                              Claim your free listing <span class="fas fa-angle-right"></span>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
                    <!-- End Link -->
                  </div>
                  <!-- End Info -->
                </div>

                <div id="SVGchattingGirl" class="col-lg-7 order-lg-1 svg-preloader">
                  <!-- SVG Icon -->
                  <figure>
                    <img class="w-75" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/saas-2.svg" alt="Image Description">
                  </figure>
                  <!-- End SVG Icon -->
                </div>
              </div>
            </div>
            <!-- End LocalNavi for -->

            <!-- About Section -->
            <div class="container space-top-2">
              <div class="row align-items-lg-center">
                <div class="col-lg-5 mb-7 mb-lg-0">
                  <!-- Info -->
                  <div class="pr-lg-7">
                    <div class="mb-4">
                      <h3 class="h4">Manage Listing</h3>
                      <p>Manage your reviews, photos, and check your business listings activity. Claim for FREE... It's one of the best investment you'll ever make.</p>
                    </div>

                    <!-- Link -->
                    <a class="card border-0 shadow-sm claim_business" href="">
                      <div class="card-body p-4">
                        <div class="media align-items-center">
                          <div class="u-avatar mr-3">
                            <figure class="ie-height-56 max-width-8 mx-auto">
                              <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-18.svg" alt="SVG" data-parent="#icon18">
                            </figure>
                          </div>
                          <span class="media-body">
                            <span class="d-flex justify-content-between align-items-center font-weight-semi-bold">
                              Claim your free listing <span class="fas fa-angle-right"></span>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
                    <!-- End Link -->
                  </div>
                  <!-- End Info -->
                </div>

                <div id="SVGchattingBoy" class="col-lg-7 svg-preloader">
                  <!-- SVG Icon -->
                  <figure class="ie-chatting-boy">
                    <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/chatting-boy.svg" alt="Image Description" data-parent="#SVGchattingBoy">
                  </figure>
                  <!-- End SVG Icon -->
                </div>
              </div>
            </div>
            <!-- End About Section -->





            <div class="mt-8 text-center">

              <a href="" class="btn btn-primary btn-wide bold claim_business">Claim your free listing</a>


              <BR><BR>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- ========== END MAIN ========== -->

</div>
<?= $this->element('claim_business_modal2', ['business' => $business]) ?>
