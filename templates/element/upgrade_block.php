<?php if (isset($claim) and $claim == true) { ?>
    <div class="row">
        <div class="col-lg-4 mb-7 mb-lg-0">
            <!-- Title -->
            <div class="pr-lg-4 mb-7">
                <span class="btn btn-xs btn-soft-primary btn-pill mb-2">Pricing plans</span>
                <h2>Upgrade your business</h2>
                <p>Attract more customers with our upgraded features. Choose the most suitable service for your needs with our reasonable prices.</p>
            </div>
            <!-- End Title -->

            <!-- Button Group -->
            <div class="btn-group btn-group-toggle">
                <a class="js-animation-link btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide active" href="javascript:;" data-target="#pricingMonthlyExample1" data-link-group="idPricingExample1" data-animation-in="slideInUp">Monthly</a>
                <a class="js-animation-link btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide" href="javascript:;" data-target="#pricingYearlyExample1" data-link-group="idPricingExample1" data-animation-in="slideInUp">
                    Yearly
                    <span class="badge badge-success badge-pill badge-bigger badge-pos">10% OFF</span>
                </a>
            </div>
            <!-- End Button Group -->
        </div>


        <div class="col-lg-8">
            <!-- Monthly Plans -->
            <div id="pricingMonthlyExample1" class="row align-items-center mb-3" data-target-group="idPricingExample1">
                <div class="col-sm-6 mb-7 mb-sm-0">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID1" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[2]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[2]->price_per_month, 2) ?></span>
                                <span>/month</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>wave-1-bottom.svg" alt="Image Description" data-parent="#SVGwave1BottomShapeID1">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <h4 class="h6 ml-3 bold mt-1">Your featured ad will appear on:</h4>
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Home page for your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Search results pages in your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Competitors pages in your city
                                    </div>
                                </li>

                                <li class="list-group-item py-2">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Members area in your city
                                    </div>
                                </li>
                            </ul>
                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[2], 'duration' => 'monthly']) ?>
                          

                            <!-- <button type="button" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover">Get Started</button> -->

                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>

                <div class="col-sm-6">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID2" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[1]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[1]->price_per_month, 2) ?></span>
                                <span>/month</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>wave-1-bottom.svg" alt="Image Description" data-parent="#SVGwave1BottomShapeID2">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Remove competitor's ads
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Respond to all your reviews
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Private message your reviewers
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Add a video (upload, youtube, or however)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Photo slideshow (choose 10 photos)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Announcements (Announce upcoming events or specials)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Call to Action (Call your visitors to take action!)
                                    </div>
                                </li>
                            </ul>

                            <!-- <button type="button" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover">Get Started</button> -->
                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[1], 'duration' => 'monthly']) ?>
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>




            </div>
            <!-- End Monthly Plans -->

            <!-- Yearly Plans -->
            <div id="pricingYearlyExample1" class="row align-items-center mb-3" style="display: none; opacity: 0;" data-target-group="idPricingExample1">
                <div class="col-sm-6 mb-7 mb-sm-0">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID3" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[2]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[2]->price_per_year, 2) ?></span>
                                <span>/year</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>wave-1-bottom.svg" alt="Image Description" data-parent="#SVGwave1BottomShapeID3">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <h4 class="h6 ml-3 bold mt-1">Your featured ad will appear on:</h4>
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Home page for your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Search results pages in your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Competitors pages in your city
                                    </div>
                                </li>

                                <li class="list-group-item py-2">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Members area in your city
                                    </div>
                                </li>
                            </ul>

                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[2], 'duration' => 'yearly']) ?>

                            <!-- <button type="button" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover">Get Started</button> -->
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>

                <div class="col-sm-6">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID4" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[1]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[1]->price_per_year, 2) ?></span>
                                <span>/year</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>wave-1-bottom.svg" alt="Image Description" data-parent="#SVGwave1BottomShapeID4">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        24/7 support
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Remove competitor's ads
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Respond to reviews
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Private message reviewer
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Add Video (upload, youtube, or however)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Photo slideshow
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Announcements
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Call to Action
                                    </div>
                                </li>
                            </ul>
                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[1], 'duration' => 'yearly']) ?>

                            <!-- <button type="button" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover">Get Started</button> -->
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->

                </div>
            </div>
            <!-- End Yearly Plans -->

            <p class="small text-muted text-center">
                * <a class="link-muted" href="<?= $this->Url->build(['controller' => 'terms', 'action' => 'index']); ?>">Terms</a> are subject to change.
            </p>
        </div>
    </div>

<?php } else { ?>

    <div class="row">
        <div class="col-lg-4 mb-7 mb-lg-0">
            <!-- Title -->
            <div class="pr-lg-4 mb-7">
                <span class="btn btn-xs btn-soft-success btn-pill mb-2">Pricing plans</span>
                <h2>Upgrade your business</h2>
                <p>Attract more customers with our upgraded features. Choose the most suitable service for your needs with our reasonable prices.</p>

                <?php if (!empty($business->current_subscription)) { ?>
                    <p>You're currently on <?= $business->current_subscription->package->name ?> </p>
                <?php } ?>
            </div>
            <!-- End Title -->

            <!-- Button Group -->
            <div class="btn-group btn-group-toggle">
                <a class="js-animation-link btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide active" href="javascript:;" data-target="#pricingMonthlyExample1" data-link-group="idPricingExample1" data-animation-in="slideInUp">Monthly</a>
                <a class="js-animation-link btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide" href="javascript:;" data-target="#pricingYearlyExample1" data-link-group="idPricingExample1" data-animation-in="slideInUp">
                    Yearly
                    <span class="badge badge-success badge-pill badge-bigger badge-pos">10% OFF</span>
                </a>
            </div>
            <!-- End Button Group -->
        </div>


        <div class="col-lg-8">
            <!-- Monthly Plans -->
            <div id="pricingMonthlyExample1" class="row align-items-center mb-3" data-target-group="idPricingExample1">
                <div class="col-sm-6 mb-7 mb-sm-0">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID1" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[0]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[0]->price_per_month, 2) ?></span>
                                <span>/month</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/wave-1-bottom.svg', ['fullBase' => true]); ?>" alt="Image Description" data-parent="#SVGwave1BottomShapeID1">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <h4 class="h6 ml-3 bold mt-1">Your featured ad will appear on:</h4>
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Home page for your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Search results pages in your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Competitors pages in your city
                                    </div>
                                </li>

                                <li class="list-group-item py-2">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Members area in your city
                                    </div>
                                </li>
                            </ul>
                            <?php if ((!empty($business->current_subscription) and $business->current_subscription->package_id > $packages[0]->id)) { ?>

                                <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[0], 'duration' => 'monthly']) ?>
                            <?php } else { ?>
                                <br>
                            <?php } ?>
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>

                <div class="col-sm-6">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID2" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[1]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[1]->price_per_month, 2) ?></span>
                                <span>/month</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/wave-1-bottom.svg', ['fullBase' => true]); ?>" alt="Image Description" data-parent="#SVGwave1BottomShapeID2">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Remove competitor's ads
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Respond to all your reviews
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Private message your reviewers
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Add a video (upload, youtube, or however)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Photo slideshow
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Announcements
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Call to Action
                                    </div>
                                </li>
                            </ul>
                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[1], 'duration' => 'monthly']) ?>
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>




            </div>
            <!-- End Monthly Plans -->

            <!-- Yearly Plans -->
            <div id="pricingYearlyExample1" class="row align-items-center mb-3" style="display: none; opacity: 0;" data-target-group="idPricingExample1">
                <div class="col-sm-6 mb-7 mb-sm-0">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID3" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[0]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[0]->price_per_year, 2) ?></span>
                                <span>/year</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/wave-1-bottom.svg', ['fullBase' => true]); ?>" alt="Image Description" data-parent="#SVGwave1BottomShapeID3">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <h4 class="h6 ml-3 bold mt-1">Your featured ad will appear on:</h4>
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Home page for your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Search results pages in your city
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Competitors pages in your city
                                    </div>
                                </li>

                                <li class="list-group-item py-2">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Members area in your city
                                    </div>
                                </li>
                            </ul>

                            <?php if ((!empty($business->current_subscription) and $business->current_subscription->package_id > $packages[0]->id)) { ?>

                                <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[0], 'duration' => 'yearly']) ?>

                            <?php } else { ?>
                                <br>
                            <?php } ?>
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->
                </div>

                <div class="col-sm-6">
                    <!-- Pricing -->
                    <div class="card border-0 shadow-sm">
                        <header id="SVGwave1BottomShapeID4" class="svg-preloader card-header border-0 position-relative bg-primary text-white p-5 pb-11">
                            <h3 class="h4 mb-1"><?= $packages[1]->name ?></h3>
                            <span class="d-block">
                                <span class="align-top">$</span>
                                <span class="display-4 font-weight-semi-bold"><?= number_format($packages[1]->price_per_year, 2) ?></span>
                                <span>/year</span>
                            </span>

                            <div class="position-absolute right-0 bottom-0 left-0">
                                <figure class="ie-wave-1-bottom">
                                    <img class="js-svg-injector" src="<?= $this->Url->build('/svg/wave-1-bottom.svg', ['fullBase' => true]); ?>" alt="Image Description" data-parent="#SVGwave1BottomShapeID4">
                                </figure>
                            </div>
                        </header>

                        <!-- Content -->
                        <div class="card-body pt-0 px-5 pb-5">
                            <ul class="list-group list-group-flush list-group-borderless mb-4">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        24/7 support
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Remove competitor's ads
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Respond to reviews
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Private message reviewer
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Add Video (upload, youtube, or however)
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Photo slideshow
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Announcements
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-xs btn-icon btn-soft-primary rounded-circle mr-3">
                                            <span class="fas fa-check btn-icon__inner"></span>
                                        </span>
                                        Call to Action
                                    </div>
                                </li>
                            </ul>
                            <?= $this->element('upgrade_btn', ['business' => $business, 'package' => $packages[1], 'duration' => 'yearly']) ?>
                        </div>
                        <!-- End Content -->
                    </div>
                    <!-- End Pricing -->

                </div>
            </div>
            <!-- End Yearly Plans -->

            <p class="small text-muted text-center">
                * <a class="link-muted" href="<?= $this->Url->build(['controller' => 'terms', 'action' => 'index']); ?>">Terms</a> are subject to change.
            </p>
        </div>
    </div>
<?php } ?>



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


        jQuery(document).on('click', '.subscribe', function(e) {
            e.preventDefault();

            var package = $(this).data("package_id");
            var duration = $(this).data("duration");

            var url = "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'checkout', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>";

            url = updateQueryString('package', package, url);
            url = updateQueryString('duration', duration, url);
            window.location.href = url;

        });
    });
</script>