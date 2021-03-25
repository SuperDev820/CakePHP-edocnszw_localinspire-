<?php $this->assign('title', 'City Manager'); ?>

<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <!-- Sidebar Info -->
            <div class="row">
                <div class="col-lg-3 mb-9 mb-lg-0">
                    <?= $this->element('city_sidebar'); ?>
                </div>
                <!-- End Sidebar Info -->
                <div class="col-lg-9 mb-9 mb-lg-0">

                    <div class="card p-5">

                        <?= $this->element('city_title', ['city_title' => 'City management account']) ?>
                        <!-- Project Title -->

                        <p class="">You have access to powerful tools and insights that can help you manage your city, analyze your city performance, monitor income and much more.

                        </p>

                        <hr>


                        <!-- Features Section -->
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                    <!-- Icon Block -->
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'earnings']); ?>">
                                        <div class="pr-lg-4">
                                            <figure id="icon5" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                                <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-5.svg" alt="SVG" data-parent="#icon5">
                                            </figure>
                                            <p> Monitor your income here, click to see how your city income is growing.</p>

                                        </div>
                                    </a>
                                    <!-- End Icon Block -->
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                    <!-- Icon Block -->
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'paymentSettings']); ?>">
                                        <div class="pr-lg-4">
                                            <figure id="icon48" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                                <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-48.svg" alt="SVG" data-parent="#icon48">
                                            </figure>
                                            <p>Add your stripe.com information (this is how you get paid). This must be done in order to be paid.</p>

                                    </a>
                                </div>
                                <!-- End Icon Block -->
                            </div>

                            <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                <!-- Icon Block -->
                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'cityDetails']); ?>">
                                    <div class="pr-lg-4">
                                        <figure id="icon13" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-13.svg" alt="SVG" data-parent="#icon13">
                                        </figure>
                                        <p>Shape how your city is presented by adding important details about your city.</p>

                                    </div>
                                </a>
                                <!-- End Icon Block -->
                            </div>

                            <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                <!-- Icon Block -->
                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'stories']); ?>">
                                    <div class="pr-lg-4">
                                        <figure id="icon12" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-12.svg" alt="SVG" data-parent="#icon12">
                                        </figure>
                                        <p>Manage the news and stories for your city, add, edit, or delete. This helps increase your presence and adds value to your city page.</p>

                                    </div>
                                </a>
                                <!-- End Icon Block -->
                            </div>

                            <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                <!-- Icon Block -->
                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'addStory']); ?>">
                                    <div class="pr-lg-4">
                                        <figure id="icon7" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-7.svg" alt="SVG" data-parent="#icon7">
                                        </figure>
                                        <p>Shape how your city is presented by creating attention-grabbing stories about your city! Let people know hot places to go!</p>

                                    </div>
                                </a>
                                <!-- End Icon Block -->
                            </div>
                            <!-- 
                            <div class="col-sm-6 col-lg-4 mb-7 mb-sm-9">
                                <a href="manager/purchased_cities">
                                    <div class="pr-lg-4">
                                        <figure id="icon8" class="svg-preloader ie-height-56 max-width-8 mb-3">
                                            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-8.svg" alt="SVG" data-parent="#icon8">
                                        </figure>
                                        <p>This is just a list of the cities you have purchased to be manager of.</p>

                                    </div>
                                </a>
                            </div> -->




                        </div>
                        <!-- End Features Section -->

                    </div>
                </div>
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
<script>
    $(document).ready(function() {

        // jQuery(document).on('change', '#active_city_select', function(e) {
        //     var city_id = $(this).select2('val');
        //     url = "<?= $this->Url->build(['controller' => 'manager', 'action' => 'switch']); ?>";
        //     url = updateQueryString('city_id', city_id, url);
        //     window.location.href = url;

        // });


    });
</script>