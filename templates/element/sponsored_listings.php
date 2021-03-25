<?php 
$colDigit = 4;
if(count($sponsoredListings) == 1){
    $colDigit = 12;
}
if(count($sponsoredListings) == 2){
    $colDigit = 6;
}
?>
<?php foreach ($sponsoredListings as $key => $sbiz) { ?>

    <div class="col-sm-<?= $colDigit?> card shadow-sm mb-5">
        <a class="customer-content-wrapa" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($sbiz->name)), strtolower($sbiz->city->name), $sbiz->city->state->code, $sbiz->id]); ?>"><img class="card-img-top" src="<?= $this->Custom->getSponsoredPhotoUrl($sbiz) ?>" alt="<?= $sbiz->name ?>">
            <span class="label label--secondary"><?= $this->Custom->displayCategoriesAndSubcategories($sbiz, true) ?></span>
            <span class="favorite">
                <i class="far fa-heart text-white"></i>
            </span>
        </a>
        <div class="card-body p-2">
            <!-- <div class="mb-2 small"> <?= $this->Custom->displayCategoriesAndSubcategories($sbiz, true) ?></div> -->
            <a class="customer-content-wrapa" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($sbiz->name)), strtolower($sbiz->city->name), $sbiz->city->state->code, $sbiz->id]); ?>"> <?= $sbiz->name; ?> </a>
            <ul class="list-inline text-white star_size12 mb-2">
                <?= $this->element('stars_count', ['rating' => $sbiz->average_rating]) ?>
                <span class="small text-secondary"> &nbsp;&nbsp; <?= $sbiz->review_count ?>&nbsp; review(s)</span>
            </ul>
            <small class="d-block"><?= $sbiz->address ?>,  <?= $sbiz->city->name; ?>, <?= strtoupper($sbiz->city->state->code); ?> - <?= $sbiz->zip ?></small>
            <div>
                <hr>
                <div class="post-meta-s">
                    <div class="media">
                        <div class="customer-ratingsm"><?= number_format(round($sbiz->average_rating), 2) ?></div>
                        <div class="media-body">
                            <p>Based on <?= $sbiz->review_count ?> people's opinion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>