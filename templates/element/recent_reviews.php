<?php foreach ($recent_reviews as $review) : ?>
    <!-- <h1><?= $recent_template ?></h1> -->
    <?php if ($recent_template == "bottom") { ?>

        <!-- Testimonials Section -->
        <div class="container space-2">
            <!-- SVG Quote -->
            <figure class="mx-auto text-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                    <path class="fill-gray-400" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5 C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3, .3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3	c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8 	C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
                </svg>
            </figure>
            <!-- End SVG Quote -->

            <!-- Blockquote -->
            <div class="w-md-80 w-lg-80  mx-md-auto mb-6">
                <blockquote class="lead text-secondary font-weight-normal review_comment"><?= $review->comment ?> </blockquote>
            </div>
            <!-- End Blockquote -->

            <!-- Reviewer -->
            <div class="d-flex justify-content-center align-items-center w-lg-50 mx-auto">
                <div class="u-avatar">
                    <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><img class="img-fluid rounded-circle border" src="<?= !empty($review->user) ?  $this->Custom->getDp($review->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"></a>
                </div>
                <div class="ml-3">
                    <h4 class="h6 mb-0"><a class="d-block h6 mb-0" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>.</a></h4>
                    <ul class="list-inline text-white star_size11 mb-0">
                        <?= $this->element('stars_count', ['rating' => $review->star_rating]) ?>
                    </ul>
                </div>
            </div>
            <!-- End Reviewer -->
        </div>
        <!-- End Testimonials Section -->
    <?php } else { ?>

        <!-- Reviews -->
        <div class="mb-5">
            <!-- Author -->
            <div class="media mb-4">
                <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $review->user->username]); ?>">
                    <img class="u-avatar rounded-circle border mr-3" src="<?= !empty($review->user) ?  $this->Custom->getDp($review->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="">
                </a>
                <div class="media-body align-self-center">
                    <h4 class="d-inline-block mb-0">
                        <a class="d-block h6 mb-0 bold" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>.</a>
                    </h4>
                    <ul class="list-inline text-white star_size11 mb-0">
                        <?= $this->element('stars_count', ['rating' => $review->star_rating]) ?>
                    </ul>
                </div>

                <div class="media-body text-right">
                    <small class="d-block text-graylt small"><?= $this->Custom->niceDateMonthDayYear($review->created) ?>.</small>
                </div>
            </div>
            <!-- End Author -->

            <p class="small review_comment"><?= $review->comment ?></p>


        </div>
        <!-- End Reviews -->

    <?php } ?>

<?php endforeach; ?>