<?php $this->assign('title', 'Write a review for ' . ucfirst($business->name)); ?>
<!-- ========== MAIN CONTENT ========== -->
<main class="" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <div class="row">

            <div class="col-lg-8 order-lg-1">

                <div class="border-bottom ">
                    <div class="h2 bold">
                        <a target="_blank" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= ucfirst($business->name) ?></a>
                    </div>
                    <div class="h6">
                        of <?= $business->city->name . ", " . strtoupper($business->city->state->code) ?>
                    </div>
                </div>

                <!-- Review Details -->
                <div class=" pt-3 mt-2 ">
                    <div class="row">
                        <div class="col-12">
                            <?= $this->element('review_form') ?>
                        </div>
                    </div>
                    <!-- End Review Details -->

                    <hr class="my-0">
                    <?= $this->element('recent_reviews', ['recent_reviews' => $recent_reviews, 'recent_template' => "bottom"]) ?>
                    <hr class="my-0">
                </div>
            </div>

            <div class="col-lg-4 order-lg-2 mb-9 mt-4 mb-lg-0">
                <!-- Title -->
                <div class="mb-4">
                    <h2 class="h5">Recent reviews of <b><?= ucfirst($business->name) ?></b></h2>
                </div>
                <!-- End Title -->
                <?= $this->element('recent_reviews', ['recent_reviews' => $recent_reviews, 'recent_template' => "side"]) ?>

            </div>


        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
<?= $this->element('add_photos_css') ?>
<?= $this->element('add_review_photos_modal') ?>

<!-- Tips For Writing Review -->
<?= $this->element('review_tips_modal') ?>

<!-- End Tips For Writing Review -->

