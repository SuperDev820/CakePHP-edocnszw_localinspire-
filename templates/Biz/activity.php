<!-- Content Section -->
<div class="bg-light">
  <main>
    <div class="container space-2">
      <div class="row">
        <div class="col-lg-3 mb-9 mb-lg-0">
          <?= $this->element('bizsidebar'); ?>
        </div>
        <div class="col-lg-9 mb-9 mb-lg-0">

          <div class="card p-0">
            <div class="pl-4 pt-4">
              <h4 class="bold">Activity</h4>
            </div>

            <!-- Features Section -->
            <div>
              <!-- Nav Classic -->
              <div class="position-relative w-lg-100 bg-white text-center z-index-2 mx-lg-auto">
                <ul class="nav nav-classic nav-justified" id="pills-tab" role="tablist">
                  <li class="nav-item border-top border-right mr-0">
                    <a class="nav-link font-weight-medium active" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="true">
                      <div class="text-left">

                        <div class="d-block font18 mb-1">User Views</div>
                        <div class="d-block font20 bold">
                          <?= $views_total ?> <span class="text-success font16 ml-2">
                            <!-- <i class="fas fa-arrow-up"></i> 22%</span> -->

                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item border-top border-right ml-0">
                    <a class="nav-link font-weight-medium" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="false">
                      <div class="text-left">
                        <div class="d-block font18 mb-1">User Reviews</div>
                        <div class="d-block font20 bold">

                          <?= $reviews_total ?> <span class="text-graylt txt-14 ml-2">(<?= $reviews_this_week ?> this week)</span>

                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item border-top border-right ml-0">
                    <a class="nav-link font-weight-medium" id="pills-three-tab" data-toggle="pill" href="#pills-three" role="tab" aria-controls="pills-three" aria-selected="false">
                      <div class="text-left">
                        <div class="d-block font18 mb-1">User Saves</div>
                        <div class="d-block font20 bold">
                          <?= $saves_total ?> <span class="text-graylt txt-14 ml-2">(<?= $saves_count_this_week ?> this week)</span>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="nav-item border-top ml-0">
                    <a class="nav-link font-weight-medium" id="pills-four-tab" data-toggle="pill" href="#pills-four" role="tab" aria-controls="pills-four" aria-selected="false">
                      <div class="text-left">
                        <div class="d-block font18 mb-1">Social Activity</div>
                        <div class="d-block font20 bold">
                          <?= $business_shares_all ?> <span class="text-graylt txt-14 ml-2">(<?= $business_shares_all_this_week ?> shares this week)</span>
                        </div>
                      </div>
                    </a>
                  </li>

                </ul>
              </div>

              <!-- End Nav Classic -->
              <div class="p-5">

                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade pt-4 show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">


                    <!-- Mockup Block -->
                    <div class="row justify-content-lg-between align-items-lg-center">
                      <div class="col-lg-12 mb-9">
                        <div class="row justify-content-center">
                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= $views_today ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">Visitors today</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= $views_this_week ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">Visitors this week</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <h4 class="display-4 text-primary mb-0"><?= $views_this_month ?></h4>
                              </div>
                              <p class="mb-0">Visitors this month</p>
                            </div>
                          </div>
                        </div>
                        <!-- End Stats -->
                      </div>
                      <?php //echo $this->element('activity_graph') 
                      ?>
                    </div>


                    <div style="margin-left:-16px;margin-right:-15px">
                      <!-- Mockup Block -->
                      <div class="row mt-5 bg-light border-top">
                        <div class="col-lg-4 mb-0 p-3 ">
                          <!-- Info -->
                          <div class="mb-5 txt-15 pl-2">
                            <h3 class="h5 font-weight-semi-bold">At a glance</h3>
                            <p>Your business profile page has received <b><?= $views_today ?></b> views today.</p>
                            <p class="mt-3">Your overall rating is <span class="btn btn-xs btn-icon btn-primary rounded-circle mr-0" style="padding: 15px;">
                                <span class="btn-icon__inner"><?= number_format(round($active_business->average_rating), 1) ?></span>
                              </span> from <b><?= $reviews_total ?></b> customer reviews.</p>
                          </div>
                          <div class="mt-2 pl-2">
                            <h3 class="h6 font-weight-semi-bold"><i class="fas font22 mr-1 fa-ad text-warning"></i> Advertising </h3>
                            <ul class="list-unstyled txt-14">
                              <p>Feature your business in a veriaty of places such as, homepage, search page, competitors pages and more, increase your business listings exposure. <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'feature']); ?>">Learn more about advertising.</a></p>
                            </ul>
                          </div>
                          <!-- End Info -->
                        </div>

                        <div class="col-lg-8 mb-3 position-relative">
                          <div class="mt-3">
                            <!-- Indicator -->
                            <?= $this->element('activity_feed') ?>
                            <!-- End Indicator -->
                          </div>
                        </div>
                      </div>
                      <!-- End Mockup Block -->
                    </div>

                    <!-- End Mockup Block -->

                  </div>

                  <div class="tab-pane fade pt-4" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">

                    <!-- Mockup Block -->
                    <div class="row justify-content-lg-between align-items-lg-center">
                      <div class="col-lg-12 mb-9">
                        <div class="row justify-content-center">
                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($reviews_today) ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">Reviews today</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($reviews_this_week) ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">Reviews this week</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <h4 class="display-4 text-primary mb-0"><?= number_format($reviews_this_month) ?></h4>
                              </div>
                              <p class="mb-0">Reviews this month</p>
                            </div>
                          </div>
                        </div>
                        <!-- End Stats -->
                      </div>


                      <?php //echo $this->element('activity_graph') 
                      ?>
                    </div>
                    <!-- /.panel -->
                    <div class="row mt-5">
                      <div class="col-lg-6 col-md-6">
                        <!-- Stats -->
                        <div class="bg-primary rounded pt-4 pb-5 px-5">
                          <!-- Title & Settings -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6 text-white mb-0 bold">Reviews from the ladies</h4>
                          </div>
                          <!-- End Title & Settings -->

                          <hr class="opacity-md mt-3 mb-3">

                          <!-- Referral Info -->
                          <div class="py-2">
                            <div class="row">
                              <div class="col-6">
                                <div class="mb-3">
                                  <span class="d-block text-white-70 font-size-1">Reviews today:</span>

                                  <span class="text-white font-size-3 font-weight-medium text-lh-sm"><?= number_format($female_reviews_today) ?></span>
                                </div>
                                <span class="text-white-70 font-size-1">This week:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($female_reviews_this_week) ?></span><br>
                                <span class="text-white-70 font-size-1">This month:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($female_reviews_this_month) ?></span><br>

                                <span class="text-white-70 font-size-1">Overall:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($female_reviews_total) ?></span>
                              </div>

                              <div class="col-6 align-self-end text-center">
                                <!-- Pie Circle -->
                                <i class="fas fa-female text-white mr-1 fa-5x"></i>
                                <!-- End Pie Circle -->
                                <div><span class="text-white font-size-1"><?= number_format($female_recommends) ?> Recommended</span> </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Referral Info -->
                        </div>
                        <!-- End Stats -->
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <!-- Stats -->
                        <div class="bg-primary rounded pt-4 pb-5 px-5">
                          <!-- Title & Settings -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6 text-white bold mb-0">Reviews from men</h4>
                          </div>
                          <!-- End Title & Settings -->

                          <hr class="opacity-md mt-3 mb-3">

                          <!-- Referral Info -->
                          <div class="py-2">
                            <div class="row">
                              <div class="col-6">
                                <div class="mb-3">
                                  <span class="d-block text-white-70 font-size-1">Reviews today:</span>

                                  <span class="text-white font-size-3 font-weight-medium text-lh-sm"><?= number_format($male_reviews_today) ?></span>
                                </div>
                                <span class="text-white-70 font-size-1">This week:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_reviews_this_week) ?></span><br>
                                <span class="text-white-70 font-size-1">This month:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_reviews_this_month) ?></span><br>

                                <span class="text-white-70 font-size-1">Overall:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_reviews_total) ?></span>
                              </div>

                              <div class="col-6 text-center align-self-end">
                                <i class="fas fa-male text-white mr-1 fa-5x"></i>
                                <div><span class="text-white font-size-1"><?= number_format($male_recommends) ?> Recommended</span> </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Referral Info -->
                        </div>
                        <!-- End Stats -->
                      </div>
                    </div>
                    <div class="text-right mt-2 txt-12"><i class="fas fa-info-circle mr-1"></i> Stats calculated by members who added their gender.</div>
                    <!-- /.row -->
                    </section>



                    <!-- End Mockup Block -->
                  </div>



                  <div class="tab-pane fade pt-4" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab">
                    <!-- Mockup Block -->
                    <div class="row justify-content-lg-between align-items-lg-center">
                      <div class="col-lg-12 mb-9">
                        <div class="row justify-content-center">
                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($saves_today) ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">User saves today</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($saves_count_this_week) ?></h4>
                                </div>
                              </div>
                              <p class="mb-0">User saves this week</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <h4 class="display-4 text-primary mb-0"><?= number_format($saves_count_this_month) ?></h4>
                              </div>
                              <p class="mb-0">User saves this month</p>
                            </div>
                          </div>
                        </div>
                        <!-- End Stats -->
                      </div>


                      <?php //echo $this->element('activity_graph') 
                      ?>
                    </div>

                    <div class="row mt-5">
                      <div class="col-lg-6 col-md-6">
                        <!-- Stats -->
                        <div class="bg-primary rounded pt-4 pb-5 px-5">
                          <!-- Title & Settings -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6 text-white mb-0 bold">Saves from the ladies</h4>
                          </div>
                          <!-- End Title & Settings -->

                          <hr class="opacity-md mt-3 mb-3">

                          <!-- Referral Info -->
                          <div class="py-2">
                            <div class="row">
                              <div class="col-6">
                                <div class="mb-3">
                                  <span class="d-block text-white-70 font-size-1">Saves today:</span>

                                  <span class="text-white font-size-3 font-weight-medium text-lh-sm"><?= number_format($female_saves_today) ?></span>
                                </div>
                                <span class="text-white-70 font-size-1">This week:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($female_saves_this_week) ?></span><br>
                                <span class="text-white-70 font-size-1">This month:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($female_saves_this_month) ?></span><br>

                                <span class="text-white-70 font-size-1">Overall:</span>
                                <span class="text-white font-weight-medium font-size-1">4,<?= number_format($female_saves_total) ?></span>
                              </div>

                              <div class="col-6 align-self-end text-center">
                                <!-- Pie Circle -->
                                <i class="fas fa-female text-white mr-1 fa-5x"></i>
                                <!-- End Pie Circle -->
                              </div>
                            </div>
                          </div>
                          <!-- End Referral Info -->
                        </div>
                        <!-- End Stats -->
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <!-- Stats -->
                        <div class="bg-primary rounded pt-4 pb-5 px-5">
                          <!-- Title & Settings -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6 text-white bold mb-0">Saves from men</h4>
                          </div>
                          <!-- End Title & Settings -->

                          <hr class="opacity-md mt-3 mb-3">

                          <!-- Referral Info -->
                          <div class="py-2">
                            <div class="row">
                              <div class="col-6">
                                <div class="mb-3">
                                  <span class="d-block text-white-70 font-size-1">Saves today:</span>

                                  <span class="text-white font-size-3 font-weight-medium text-lh-sm"><?= number_format($male_saves_today) ?></span>
                                </div>
                                <span class="text-white-70 font-size-1">This week:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_saves_this_week) ?></span><br>
                                <span class="text-white-70 font-size-1">This month:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_saves_this_month) ?></span><br>

                                <span class="text-white-70 font-size-1">Overall:</span>
                                <span class="text-white font-weight-medium font-size-1"><?= number_format($male_saves_total) ?></span>
                              </div>

                              <div class="col-6 text-center align-self-end">
                                <i class="fas fa-male text-white mr-1 fa-5x"></i>
                              </div>
                            </div>
                          </div>
                          <!-- End Referral Info -->
                        </div>
                        <!-- End Stats -->
                      </div>
                    </div>
                    <div class="text-right mt-2 txt-12"><i class="fas fa-info-circle mr-1"></i> Stats calculated by members who added their gender.</div>
                    <!-- /.row -->
                    </section>


                    <!-- End Mockup Block -->
                  </div>

                  <div class="tab-pane fade pt-4" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab">
                    <!-- Mockup Block -->
                    <div class="row justify-content-lg-between align-items-lg-center mb-9">
                      <div class="col-md-6">
                        <h5 class="text-center bold mt-2 mb-5">Business Shares</h5>
                        <div class="row justify-content-center">
                          <div class="col-md-6">

                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($business_shares_facebook) ?></h4>
                                </div>
                              </div>
                              <p class="mb-4">Facebook shares</p>
                            </div>
                            <!-- End Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                 <div class="u-indicator-dots">
                                <h4 class="display-4 text-primary mb-0"><?= number_format($business_facebook_clicks) ?></h4>
                                </div>
                              </div>
                              <p class="mb-4">Facebook clicks</p>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <!-- <div class="u-indicator-dots"> -->
                                <h4 class="display-4 text-primary mb-0"><?= number_format($business_shares_twitter) ?></h4>
                                <!-- </div> -->
                              </div>
                              <p class="mb-4">Twitter tweets</p>
                            </div>
                            <!-- End Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <!-- <div class="u-indicator-dots"> -->
                                <h4 class="display-4 text-primary mb-0"><?= number_format($business_twitter_clicks) ?></h4>
                                <!-- </div> -->
                              </div>
                              <p class="mb-4">Twitter clicks</p>
                            </div>
                          </div>

                        </div>
                        <!-- End Stats -->
                      </div>

                      <div class="col-md-6">
                        <h5 class="text-center mt-2 bold mb-5">Review Shares</h5>
                        <div class="row justify-content-center">
                          <div class="col-md-6">

                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($business_review_shares_facebook) ?></h4>
                                </div>
                              </div>
                              <p class="mb-4">Facebook shares</p>
                            </div>
                            <!-- End Stats -->
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <div class="u-indicator-dots">
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($review_facebook_clicks) ?></h4>
                                </div>
                              </div>
                              <p class="mb-4">Facebook clicks</p>
                            </div>
                            <!-- End Stats -->
                          </div>

                          <div class="col-md-6">
                            <!-- Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                                <!-- <div class="u-indicator-dots"> -->
                                <h4 class="display-4 text-primary mb-0"><?= number_format($business_review_shares_twitter) ?></h4>
                                <!-- </div> -->
                              </div>
                              <p class="mb-4">Twitter tweets</p>
                            </div>
                            <!-- End Stats -->
                            <div class="text-center">
                              <div class="position-relative">
                              
                                  <h4 class="display-4 text-primary mb-0"><?= number_format($review_twitter_clicks) ?></h4>
                               
                              </div>
                              <p class="mb-4">Twitter clicks</p>
                            </div>
                          </div>

                        </div>
                        <!-- End Stats -->
                      </div>

                      <!-- End Info -->
                    </div>
                   

                  </div>
                  <!-- End Mockup Block -->
                </div>
                <!-- End Mockup Block -->
              </div>

              <!-- End Tab Content -->
            </div>
            <!-- End Features Section -->

          </div>
        </div>
      </div>
    </div>
    <!-- End Content Section -->
  </main>
  <!-- ========== END MAIN ========== -->
</div>
<!-- ========== SECONDARY CONTENTS ========== -->