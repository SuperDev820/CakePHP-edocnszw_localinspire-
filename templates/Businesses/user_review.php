<?php $this->assign('title', ucfirst($review->title) . " - Reviews for " . $business->name . " - " . $business->city->name . ", " . $business->city->state->code); ?>

<?php $this->assign('image', !empty($review->business_review_photos) ? $this->Custom->getDp($review->business_review_photos[0]->photo, 'reviews') : $this->Custom->getBusinessPhotoUrl($business, true)); ?>
<?php //echo $this->element('user_review_css') 
?>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter bg-transparent txt-12lt">
                <li class="breadcrumb-item"><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a></li>
                <li class="breadcrumb-item " aria-current="page"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>'s review of <?= $business->name ?></li>
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
                                <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a>
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
                    <?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>'s review of <?= $business->name ?>
                </h4>
                <!-- End Header -->
                <?= $this->element('review_block', ['review' => $review, 'nolinkurl' => true]) ?>

                <!-- End Freelancers -->
                <!-- Review Details -->

                <!-- End Review Details -->
                <hr class="my-0">
                <!-- Testimonials Section -->
                <div class="container space-2">
                    <!-- SVG Quote -->
                    <figure class="mx-auto text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                            <path class="fill-gray-400" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
							C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
							c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
							C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
                        </svg>
                    </figure>
                    <!-- End SVG Quote -->

                    <!-- Blockquote -->
                    <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-6">
                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">
                            <blockquote class="lead text-secondary font-weight-normal"><?= $review->advice ?>... </blockquote>
                        </a>
                    </div>
                    <!-- End Blockquote -->

                    <!-- Reviewer -->
                    <div class="d-flex justify-content-center align-items-center w-lg-50 mx-auto">
                        
                        
                         <div class="u-avatar mr-3">
                <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><img class="u-avatar border rounded-circle mr-3" src="<?= !empty($review->user) ?  $this->Custom->getDp($review->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"></a>
            </div>
                        
                       
                        <div class="ml-3">
                            <h4 class="h6 mb-0"><a class="d-block h6 bold mb-0" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>.</a></h4>
                            <span class="d-block txt-12 text-gray-dark"><i class="fas fa-map-marker-alt txt-12 text-gray-dark"></i>
                                <?= !empty($review->user->city) ? $review->user->city->name . ", " . strtoupper($review->user->city->state->code) : ""; ?>
                                &bull;
                                <?= $this->Custom->userContributions($review->user) ?>
                                contributions</span>
                        </div>
                    </div>
                    <!-- End Reviewer -->
                </div>
                <!-- End Testimonials Section -->
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