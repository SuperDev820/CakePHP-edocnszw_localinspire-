<style>
</style>

<div class="js-slide card border-0 shadow-sm mb-3">
    <div class="position-relative">

        <?php if (!empty($active_business->primary_photo) or !empty($active_business->photo)) { ?>
            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $this->Custom->businessPhotoUser($active_business)->username]); ?>">
                <div class="card-img-top" style="background-image:url(<?= $this->Custom->getBusinessPhotoUrl($active_business) ?>"></div>
            </a>

        <?php } else { ?>
            <div class="card-img-top" style="background-image:url(<?= $this->Custom->getBusinessPhotoUrl($active_business) ?>"></div>
        <?php } ?>


        <div style="background-color: rgba(0,0,0,0.5);border-top-right-radius:8px" class="position-absolute right-1 bottom-0 left-0 p-4">
            <span class="h6 text-white"><i class="fas fa-thumbs-up mr-1"></i> <?= !empty($active_business->primary_photo->helpful_count) ? $active_business->primary_photo->helpful_count : (!empty($active_business->photo->helpful_count)? $active_business->photo->helpful_count : 0) ?> &nbsp;helpful votes</span>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="media align-items-center text-graylt">
            <div class="mr-2">
                <img class="u-sm-avatar border rounded-circle" src="<?= !empty($this->Custom->businessPhotoUser($active_business)) ?  $this->Custom->getDp(($this->Custom->businessPhotoUser($active_business))->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
            </div>
            <div class="media-body txt-12lt bold">
                <?php if (!empty($this->Custom->businessPhotoUser($active_business))) { ?>
                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $this->Custom->businessPhotoUser($active_business)->username]); ?>"><span><?= 'Added by ' . $this->Custom->businessPhotoUser($active_business)->name_desc   ?></span></a>
                <?php } else { ?>
                <?php } ?>
            </div>
            <div class="media-body text-right">
                <span class="badge badge-primary p-1">Primary photo</span>
            </div>
        </div>

    </div>
</div>