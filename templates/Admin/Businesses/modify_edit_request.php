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

    <hr class="my-0">
    <!-- Testimonials Section -->
    <!-- <div class="container space-2"> -->
    <!-- SVG Quote -->
    <!-- <figure class="mx-auto text-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                <path class="fill-gray-400" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
        C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
        c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
        C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
            </svg>
        </figure> -->
    <!-- End SVG Quote -->

    <!-- Blockquote -->
    <!-- <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-6">
            <blockquote class="lead text-secondary font-weight-normal">The template is really nice and offers quite a
                large set of options. It's beautiful and the coding is done quickly and seamlessly. Thank you!
            </blockquote>
        </div> -->
    <!-- End Blockquote -->

    <!-- Reviewer -->
    <!-- <div class="d-flex justify-content-center align-items-center w-lg-50 mx-auto">
            <div class="u-avatar">
                <img class="img-fluid rounded-circle" src="https://via.placeholder.com/160x160/img17.png" alt="Image Description">
            </div>
            <div class="ml-3">
                <h4 class="h6 mb-0">Maria Muszynska</h4>
                <small class="text-muted">Head of IT department at Google</small>
            </div>
        </div> -->
    <!-- End Reviewer -->
    <!-- </div> -->
    <!-- End Testimonials Section -->
    <hr class="my-0">
</main>
<!-- ========== END MAIN CONTENT ========== -->
