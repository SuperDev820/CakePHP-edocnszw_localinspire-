<?php $this->assign('title', "Upgrade " . $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code)); ?>

<!-- ========== MAIN CONTENT ========== -->

<main id="content" role="main">
    <!-- Hero Section -->
    <div id="SVGwave1BottomSMShape" class="svg-preloader position-relative gradient-half-primary-v1">
        <div class="container space-top-2 space-top-md-4 space-bottom-4">
            <div class="w-md-80 w-lg-60 text-center mx-auto">
                <div class="mb-6">
                    <h1 class="text-white">Find the <span class="font-weight-semi-bold">right plan</span> for your business</h1>
                </div>

                <!-- Button Group -->
                <div class="btn-group btn-group-toggle mb-4">
                    <a class="change_price js-animation-link btn btn-outline-light btn-custom-toggle-white btn-sm-wide active" href="javascript:;" data-target="#pricingMonthly" data-price="monthly" data-link-group="idPricing">
                        Monthly
                    </a>
                    <a class="change_price js-animation-link btn btn-outline-light btn-custom-toggle-white btn-sm-wide" href="javascript:;" data-target="#pricingYearly" data-price="yearly" data-link-group="idPricing">
                        Yearly
                        <span class="badge badge-success badge-pill badge-bigger badge-pos">10% OFF</span>
                    </a>
                </div>
                <!-- End Button Group -->
            </div>
        </div>

        <!-- SVG Background -->
        <figure class="position-absolute right-0 bottom-0 left-0">
            <img class="js-svg-injector" src="<?= $this->Url->build('/svg/wave-1-bottom-sm.svg', ['fullBase' => true]); ?>" alt="Image Description" data-parent="#SVGwave1BottomSMShape">
        </figure>
        <!-- End SVG Background -->
    </div>
    <!-- End Hero Section -->

    <!-- Pricing Section -->
    <div class="position-relative mt-n23 z-index-2">
        <div class="container">
            <div class="space-bottom-2 space-bottom-md-3">
                <!-- Pricing Carousel -->
                <div id="pricingMonthly" data-target-group="idPricing">
                    <div class="js-slick-carousel u-slick u-slick--gutters-2 z-index-2" data-slides-show="3" data-adaptive-height="true" data-slides-scroll="1" data-pagi-classes="d-lg-none text-center u-slick__pagination mt-7 mb-0" data-responsive='[{
                   "breakpoint": 1200,
                   "settings": {
                     "slidesToShow": 3
                   }
                 }, {
                   "breakpoint": 992,
                   "settings": {
                     "slidesToShow": 2
                   }
                 }, {
                   "breakpoint": 768,
                   "settings": {
                     "slidesToShow": 1
                   }
                 }, {
                   "breakpoint": 554,
                   "settings": {
                     "slidesToShow": 1
                   }
                 }]'>
                        <div class="js-slide">
                            <!-- Pricing -->
                            <div class="card transition-3d-hover mt-1">
                                <!-- Header -->
                                <header class="card-header text-center p-5">
                                    <h2 class="h6 text-primary mb-3"><?= $packages[0]->name ?></h2>
                                    <span class=" price_per_month">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[0]->price_per_month, 2) ?>
                                        </span>
                                        <span class=" text-secondary font-size-1">per month</span>
                                    </span>
                                    <span class=" price_per_year" style="display: none;">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[0]->price_per_year, 2) ?>
                                        </span>
                                        <span class=" text-secondary font-size-1">per year</span>
                                    </span>
                                </header>
                                <!-- End Header -->

                                <!-- Content -->
                                <div class="card-body p-5">
                                    <!-- <ul class="list-group list-group-flush list-group-borderless mb-4">
                                        <li class="list-group-item">Community support</li>
                                        <li class="list-group-item">500+ pages</li>
                                    </ul> -->

                                    <?= $packages[0]->description  ?>


                                    <button type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[0]->id ?>" data-duration="monthly" class="price_per_month btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[0]->name ?></button>
                                    <button style="display:none;" type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[0]->id ?>" data-duration="yearly" class="price_per_year btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[0]->name ?></button>
                                </div>
                                <!-- End Content -->
                            </div>
                            <!-- End Pricing -->
                        </div>

                        <div class="js-slide">
                            <!-- Pricing -->
                            <div class="card transition-3d-hover mt-1">
                                <!-- Header -->
                                <header class="card-header text-center p-5">
                                    <h3 class="h6 text-warning mb-3"><?= $packages[1]->name ?></h3>
                                    <span class=" price_per_month">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[1]->price_per_month, 2) ?>
                                        </span>
                                        <span class=" text-secondary font-size-1">per month</span>
                                    </span>
                                    <span class=" price_per_year" style="display: none;">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[1]->price_per_year, 2) ?>
                                        </span>
                                        <span class=" text-secondary font-size-1">per year</span>
                                    </span>
                                </header>
                                <!-- End Header -->

                                <!-- Content -->
                                <div class="card-body p-5">
                                    <?= $packages[1]->description ?>
                                    <button type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[1]->id ?>" data-duration="monthly" class="price_per_month btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[1]->name ?></button>
                                    <button style="display:none;" type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[1]->id ?>" data-duration="yearly" class="price_per_year btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[1]->name ?></button>
                                </div>
                                <!-- End Content -->
                            </div>
                            <!-- End Pricing -->
                        </div>

                        <div class="js-slide">
                            <!-- Pricing -->
                            <div class="card transition-3d-hover mt-1">
                                <!-- Header -->
                                <header class="card-header text-center p-5">
                                    <h4 class="h6 text-success mb-3"><?= $packages[2]->name ?></h4>
                                    <span class=" price_per_month">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[2]->price_per_month, 2) ?>
                                        </span>
                                        <span class=" text-secondary font-size-1">per month</span>
                                    </span>
                                    <span class="price_per_year" style="display: none;">
                                        <span class="display-4 text-dark font-weight-normal">
                                            <span class="align-top font-size-2">$</span><?= number_format($packages[2]->price_per_year, 2) ?>
                                        </span>
                                        <span class="text-secondary font-size-1">per year</span>
                                    </span>
                                </header>
                                <!-- End Header -->

                                <!-- Content -->
                                <div class="card-body p-5">
                                    <!-- <ul class="list-group list-group-flush list-group-borderless mb-4">
                                        <li class="list-group-item">Community support</li>
                                        <li class="list-group-item">500+ pages</li>
                                        <li class="list-group-item">100+ header variations</li>
                                        <li class="list-group-item">30+ home page options</li>
                                    </ul> -->

                                    <?= $packages[2]->description ?>

                                    <button type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[2]->id ?>" data-duration="monthly" class="price_per_month btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[2]->name ?></button>
                                    <button style="display:none;" type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $packages[2]->id ?>" data-duration="yearly" class="price_per_year btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $packages[2]->name ?></button>

                                </div>
                                <!-- End Content -->
                            </div>
                            <!-- End Pricing -->
                        </div>

                    </div>
                </div>
                <!-- End Pricing Carousel -->
            </div>

            <!-- Divider -->
            <div class="w-80 mx-auto">
                <hr class="my-0">
            </div>
            <!-- End Divider -->
        </div>
    </div>
    <!-- End Pricing Section -->

    <!-- FAQ Section -->
    <div class="container space-2 space-md-3">
        <!-- Title -->
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <small class="btn btn-xs btn-soft-success btn-pill mb-2">Help</small>
            <h2 class="text-primary">Frequently asked <span class="font-weight-semi-bold">questions</span>:</h2>
        </div>
        <!-- End Title -->

        <!-- FAQ -->
        <div class="space-bottom-2 space-bottom-md-3">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <div class="pr-md-4">
                        <h3 class="h6">Can I cancel at anytime?</h3>
                        <p>Yes, you can cancel anytime no questions are asked while you cancel but we would highly appreciate if you will give us some feedback.</p>
                    </div>
                </div>

                <div class="col-md-6 mb-5">
                    <div class="pl-md-4">
                        <h3 class="h6">Do you offer discounts?</h3>
                        <p>Yes we do. We've built in discounts at each tier for teams.</p>
                    </div>
                </div>

                <div class="w-100"></div>

                <div class="col-md-6 mb-5">
                    <div class="pr-md-4">
                        <h3 class="h6">How does LocalInspire's pricing work?</h3>
                        <p>Our subscriptions are tiered. Understanding the task at hand and ironing out the wrinkles is key.</p>
                    </div>
                </div>

                <div class="col-md-6 mb-5">
                    <div class="pl-md-4">
                        <h3 class="h6">How secure is LocalInspire?</h3>
                        <p>Protecting the data you trust to LocalInspire is our first priority. This part is really crucial in keeping the project in line to completion.</p>
                    </div>
                </div>

                <div class="w-100"></div>

                <div class="col-md-6 mb-5 mb-md-0">
                    <div class="pr-md-4">
                        <h3 class="h6">What is your refund policy?</h3>
                        <p>We offer refunds. We aim high at being focused on building relationships with our clients and community.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pl-md-4">

                    </div>
                </div>
            </div>
        </div>
        <!-- End FAQ -->

        <!-- Divider -->
        <!-- <div class="w-80 mx-auto">
            <hr class="my-0">
        </div> -->
        <!-- End Divider -->
    </div>
    <!-- End FAQ Section -->

</main>
<!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/slick-carousel/slick/slick.js"></script> -->

<!-- JS Implementing Plugins -->
<!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.slick-carousel.js"></script> -->
<!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/js/components/sr.show-animation.js"></script> -->
<script>
    $(document).ready(function() {
        jQuery(document).on('click', '.subscribe', function(e) {
            e.preventDefault();

            var package = $(this).data("package_id");
            var duration = $(this).data("duration");

            var url = "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'checkout', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>";

            url = updateQueryString('package', package, url);
            url = updateQueryString('duration', duration, url);
            window.location.href = url;

        });
        jQuery(document).on('click', '.change_price', function(e) {
            e.preventDefault();

            var price = $(this).data("price");
            if (price == "monthly") {
                $('.price_per_month').show();
                $('.price_per_year').hide();
            } else {
                $('.price_per_month').hide();
                $('.price_per_year').show();
            }

        });
    });
</script>