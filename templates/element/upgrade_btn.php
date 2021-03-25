<?php if ((!empty($business->current_subscription) and $business->current_subscription->package_id == $package->id)) { ?>
    <button type="button" data-package="<?= $package->name ?>" data-business_id="<?= $business->id ?>" data-package_id="<?= $package->id ?>" data-duration="<?= $duration ?>"  data-subscription_id="<?= $business->current_subscription->id ?>" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover cancel_subscription">Cancel <?= $package->name ?></button>
<?php } else { ?>
    <button type="button" data-business_id="<?= $business->id ?>" data-package_id="<?= $package->id ?>" data-duration="<?= $duration ?>" class="btn btn-sm btn-block btn-soft-primary transition-3d-hover subscribe">Get <?= $package->name ?></button>
<?php } ?>