<!-- Content Section -->
<div class="bg-light">
  <main>
    <div class="container space-2">
      <div class="row">
        <div class="col-lg-3 mb-9 mb-lg-0">
          <?= $this->element('bizsidebar'); ?>
        </div>
        <div class="col-lg-9 mb-9 mb-lg-0">
          <div class="card p-5">
            <?php if (empty($active_business->current_subscription)) { ?>
              <h3>Basic account for <B><?= $active_business->name ?></B>!</h3>

              <p class="">Your <b>Basic account</b> gives you limited access. With the <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'upgrade']); ?>">upgrade</a> option you'll have access to powerful tools and insights that can help you manage your online reputation, analyze your listings performance, and respond to reviews of customers worldwide.
              </p>

            <?php } else { ?>


              <h3><?= $active_business->current_subscription->package->name ?> package for <B><?= $active_business->name ?></B>!</h3>
              <p> Your <b><?= $active_business->current_subscription->package->name ?></b> gives access to powerful tools and insights that can help you manage your online reputation, analyze your listings performance, and respond to reviews of customers worldwide. </p>

            <?php } ?>
            <hr><br>

            <?php if (1 == 2) { ?>

              <!-- Freelancers -->
              <div class="card-deck d-block d-lg-flex">
                <!-- Item -->
                <div class="card mb-5">
                  <!-- Header -->
                  <header class="card-header bg-light py-2 px-3">
                    <div class="row justify-content-between align-items-center no-gutters">
                      <div class="col-3">
                        <span class="font18 text-secondary" href="#">
                          <span class="fas fa-star text-primary mr-1"></span>

                        </span>
                      </div>

                      <div class="col-9 text-right">


                        <!-- Icons -->
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item mr-0">
                            <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="#" data-toggle="tooltip" data-placement="top" title="Report review">
                              <span class="fas fa-flag btn-icon__inner"></span>
                            </a>
                          </li>
                          <li class="list-inline-item mr-0">
                            <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="#" data-toggle="tooltip" data-placement="top" title="Share review">
                              <span class="fas fa-share btn-icon__inner"></span>
                            </a>
                          </li>
                          <li class="list-inline-item mr-0">
                            <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="#" data-toggle="tooltip" data-placement="top" title="Set as featured">
                              <span class="far fa-star btn-icon__inner"></span>
                            </a>
                          </li>

                          <li class="list-inline-item mr-0">
                            <!-- Settings Dropdown -->
                            <div class="position-relative">
                              <a id="createProjectSettingsDropdown1Invoker" class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="javascript:;" role="button" aria-controls="createProjectSettingsDropdown1" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#createProjectSettingsDropdown1" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                <span class="fas fa-ellipsis-h btn-icon__inner"></span>
                              </a>

                              <div id="createProjectSettingsDropdown1" class="dropdown-menu dropdown-unfold dropdown-menu-right" aria-labelledby="createProjectSettingsDropdown1Invoker" style="min-width: 160px;">
                                <a class="dropdown-item" href="#">Message reviewer</a>
                                <a class="dropdown-item" href="#">Respond to review</a>

                              </div>
                            </div>
                            <!-- End Settings Dropdown -->
                          </li>
                        </ul>
                        <!-- End Icons -->
                      </div>
                    </div>
                  </header>
                  <!-- End Header -->
                  <div class="card-body p-4">
                    <!-- Header -->
                    <div class="media align-items-center mb-4">
                      <!-- Avatar -->
                      <div class="u-avatar position-relative mr-3">
                        <img class="img-fluid rounded-circle" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>img/e6057c03e782fbaa61175f703250da0b.jpg" alt="Image Description">

                      </div>
                      <!-- End Avatar -->

                      <div class="media-body">
                        <h1 class="h6 bold mb-0">
                          <a href="employee-profile.html">Jorge Fields</a>
                        </h1>
                        <small class="text-graylt">Terrell, Tx &bull; on January 15, 2019</small>
                      </div>
                    </div>
                    <!-- End Header -->
                    <small class="text-graylt bold">Let me start out w I am sitting at the table waiting on my peach cobbler w ice cream.</small>
                    <p class="font-size-1">Oh My Gosh. Let me start out w I am sitting at the table waiting on my peach cobbler w ice cream. I just finished the incredible Chicken Nathan, and sipping on my watermelon peach mango ice tea. I was driving down Main St. and happen to notice the Main Street Cafe. A man has to eat lunch somewhere. I am so glad I pulled over and went in. Atmosphere, food, service and price = GREATNESS! What a find. Be back next Wednesday eve for supper and 1/2 price wine. Highly recommend a visit.</p>

                    <div class="text-gray mt-3 txt-14 text-center mb-2" style="display: flex; justify-content: space-between;">

                      <div class="select_star1" style="float:left;">
                        <div style="text-align:center"><strong> Value</strong></div>
                        <div style="text-align:center">
                          <div id="demo">
                            5 </div>
                        </div>
                      </div>
                      <div class="select_star2" style="float:left;">
                        <div style="text-align:center"><strong>Location</strong></div>
                        <div style="text-align:center">
                          <div id="demo">
                            5 </div>
                        </div>
                      </div>
                      <div class="select_star3" style="float:left;">
                        <div style="text-align:center"><strong>Service</strong></div>
                        <div style="text-align:center">
                          <div id="demo">
                            4 </div>
                        </div>
                      </div>
                      <div class="select_star4" style="float:left;">
                        <div style="text-align:center"><strong>Sleep Quality</strong></div>
                        <div style="text-align:center">
                          <div id="demo">
                            3 </div>
                        </div>
                      </div>
                      <div class="select_star5" style="float:left;">
                        <div style="text-align:center"><strong>Atmosphere</strong></div>
                        <div style="text-align:center">
                          <div id="demo">
                            5 </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="card-footer border-top-0 pt-0 px-4 pb-4">
                    <div class="d-sm-flex align-items-sm-center">

                      <!-- Hourly -->
                      <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                        <h3 class="small text-text-graylt mb-0">Date of visit</h3>
                        <small class="fas fa-calendar-alt text-graylt mr-1"></small>
                        <span class="align-middle font-size-1 font-weight-medium"> August 2019</span>
                      </div>
                      <!-- End Hourly -->

                      <!-- Projects -->
                      <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                        <h4 class="small text-text-graylt mb-0">Visit type</h4>
                        <small class="fas fa-user-friends text-graylt mr-1"></small>
                        <span class="align-middle font-size-1 font-weight-medium">Couples</span>
                      </div>
                      <!-- End Projects -->

                      <!-- Review -->
                      <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0 small">
                        <div class="text-white txt-12 mb-1">
                          <span class="fas fa-star star_border"></span>
                          <span class="fas fa-star star_border"></span>
                          <span class="fas fa-star star_border"></span>
                          <span class="fas fa-star star_border"></span>
                          <span class="fas fa-star star_border"></span>
                        </div>
                        <span class="font-weight-semi-bold">4.0</span>
                        <span class="text-muted">( <i class='small material-icons text-primary mr-1'>beenhere</i>
                          <span class="align-middle font-size-1 font-weight-medium">recommends</span>)</span>
                      </div>
                      <!-- End Review -->

                      <!-- Review -->
                      <div class="u-ver-divider u-ver-divider--none-sm pr-4 mr-4 mb-3 mb-sm-0">
                        <div class="mb-1">
                          <h4 class="small text-text-graylt mb-0">20 people found this review <span class="fas fa-thumbs-up text-black-50 txt-14 ml-1 mr-1"></span> helpful</h4>

                        </div>

                      </div>
                      <!-- End Review -->

                    </div>
                  </div>
                </div>
                <!-- End Item -->


              </div>
              <!-- End Freelancers -->
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- End Content Section -->
  </main>
  <!-- ========== END MAIN ========== -->
</div>
<!-- ========== SECONDARY CONTENTS ========== -->


<!-- Request Payment Modal Window -->
<?= $this->element('request_payment_modal') ?>
<!-- End Request Payment Modal Window -->