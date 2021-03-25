<div class="media mt-3 mb-3">
    <img class="u-avatar square-img95 mr-3" src="<?= (isset($sponsored) and $sponsored == true) ? $this->Custom->getSponsoredPhotoUrl($business) : $this->Custom->getBusinessPhotoUrl($business) ?>" alt="<?= $business->name ?>">
    <div>
        <h4 class="d-inline-block mb-0">
            <span class="h6 bold"><?= $data_key + 1 ?>.</span>
            <a class="h6 mb-0 bold text-primary" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?php echo $business->name; ?></a>
        </h4>
        <small class="d-block"><span data-toggle="tooltip" data-placement="top" title="Price range of business"><?= $this->Custom->displayCategoriesAndSubcategories($business, true) ?></span> <br>
            <?= $business->city->name; ?>, <?= strtoupper($business->city->state->code); ?> - <?= $business->zip ?></small>
        <?php if (isset($sponsored) and $sponsored == true) { ?>
            <?php if (!empty($business->ad)) { ?>
                <small><strong><?= !empty($business->ad->business_review->user) ? ucfirst($business->ad->business_review->user->firstname) . ' said: ' : '' ?></strong><?= $business->ad->business_review->title ?>
                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->ad->business_review->id]); ?>">
                        <span>&nbsp;see more</span>
                    </a>
                </small>
            <?php } else { ?>
                <small><?= $business->description ?></small>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="media-body text-right">
        <small class="d-block">
            <!-- Rating -->
            <div class="position-relative">
                <span class="btn btn-soft-primary rounded-circle">
                    <?= number_format(round($business->average_rating), 1) ?>
                </span>
            </div>
            <!-- End Rating -->
        </small>
    </div>
</div>

<?php if (isset($sponsored) and $sponsored == true) { ?>

<?php } else { ?>
    <!-- End Author -->
    <div class="media pr-lg-5">
        <div class="media-body">
            <span class="d-block font-size-1">Been here before? Would you recommend
                <b><?php echo $business->name; ?></b>? &nbsp;&nbsp;
                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'yes']]); ?>"> <button type="button" class="btn btn-link borderlt bold btn-xs recommendYes">Yes</button></a>
                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'no']]); ?>"> <button type="button" class="btn btn-link borderlt bold btn-xs recommendNo">No</button></a>
            </span>
        </div>
    </div>
    <!-- End Reviews -->
<?php } ?>
<hr>