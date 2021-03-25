<?php $this->assign('title', "Reviews History " . $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code)); ?>
<?php //echo $this->element('user_review_css') 
?>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter bg-transparent txt-12lt">
                <li class="breadcrumb-item"><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a></li>
                <li class="breadcrumb-item " aria-current="page"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>'s review update history on <?= $business->name ?></li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-lg-4 order-lg-2 mb-9 mt-8 mb-lg-0">
                <div class="portfolio-item">
                    <div class="card h-100">
                        <a href="#">
                            <img class="card-img-top" src="<?= $this->Custom->getBusinessPhotoUrl($business) ?>" alt="">
                        </a>
                        <div class="card-body">
                            <h4 class=" h5 card-title mb-1">
                                <a class="bold" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a>
                            </h4>
                            <ul class="list-inline text-white star_size13 mb-2">
                                <?= $this->element('stars_count', ['rating' => $business->average_rating]) ?>
                                <span class="txt-14 ml-1 text-graylt"> <?= $review_counts ?> reviews</span>
                            </ul>
                            <span class="d-block"><?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?> </span>

                            <span class="d-block small"><?= $this->Custom->displayCategoriesAndSubcategories($business) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 order-lg-1">
                <h4 class="bold">
                    <?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>'s review update history on <?= $business->name ?>
                </h4>

                <?php foreach ($histories as $key => $history) { ?>
                    <!-- End Header -->
                    <?= $this->element('review_block', ['review' => $history, 'nolinkurl' => true, 'showinghistory' => true]) ?>
                <?php } ?>

                <!-- End Freelancers -->
                <!-- Review Details -->

                <!-- End Review Details -->
                <hr class="my-0">
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- Report Owner Modal Window -->
<?= $this->element('report_owner_modal') ?>

<!-- Report Review Modal Window -->
<?= $this->element('report_review_modal') ?>
<!-- End Report Review Modal Window -->

<?= $this->element('share_review_modal') ?>

<!-- Report Success Modal Window -->
<?= $this->element("success_modal") ?>

<!-- Report Photos Modal Window -->
<?= $this->element('report_photo_modal') ?>
<!-- End Report Photos Modal Window -->

<?= $this->element('review_scripts') ?>