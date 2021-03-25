<?php $this->assign('title', 'Edit business'); ?>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">
    <!-- Hero -->


    <!-- End Hero -->
    <!-- Add Listing Section -->
    <div class="container space-2">


        <!-- Contact Section -->
        <div id="SVGcontactsSection" class="svg-preloader position-relative ">
            <div class="container position-relative z-index-2">
                <div class="row">


                    <div class="col-lg-6">
                        <!-- Contact Us -->
                        <div class="d-flex align-items-center min-height-155 pl-lg-7">

                        </div>

                        <figure class="w-75 position-absolute right-0 bottom-0">
                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/pushing-boundaries.svg" alt="SVG Illustration" data-parent="#SVGcontactsSection">
                        </figure>
                        <!-- End Contact Us -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6 position-absolute top-0 left-0 min-height-380"></div>
        </div>
        <!-- End Contact Section -->

        <div class="row">

            <div class="card col-lg-8 order-lg-1 small">

                <!-- Title -->
                <div class="mt-2 mb-1">
                    <h2 class="h4 bold">Edit Business</h2>
                </div>
                <!-- End Title -->

                <?= $this->element('business_form') ?>
            </div>

            <?= $this->element('how_it_works') ?>


        </div>

    </div>
    <!-- End Checkout Section -->

</main>
<!-- ========== END MAIN CONTENT ========== -->
