<div class="col-sm-<?= $div ?> mb-3 space1">
    <?php $photo_folder = !empty($photo->business_id) ? 'businesses' : 'reviews' ?>
    <div class="image-gallery-item" style="background-image:url(<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>)">
        
        <a class="gallery gallery_item_<?= $photo->id ?>" href="<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>" data-src="<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>" data-sub-html="#biz_photo_gallery_side_model<?= $i ?>" style="height: 100%;display: block;" data-bid="<?= $photo->business_id ?>" data-photo_id="<?= $photo->id ?>" data-helfulc="<?= $photo->helpful_count ?>">

            <!--			<img class="img-fluid imgh" src="--><? //=base_url()
                                                                ?>
            <!--Images/--><? //=$photo['photo']
                            ?>
            <!--" alt="Image Description">-->
            <?php if ($i == $show_count - 1) : ?>
                <span class="containeradd">
                    <button type="button" class="btn btn-link btn-text-white mb-1">
                        <i class="fas fa-camera mr-2"></i>
                        All photos (<?= count($all_business_photos) ?>)
                    </button>
                </span>
            <?php endif; ?>

        </a>
        <div class="row" id="biz_photo_gallery_side_model<?= $i ?>" style="display: none;">

            <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop pr-3 pl-3">
                <!-- Author -->
                <div class="media pr pt-3 pb-1">
                    <div class="u-avatar mr-3">
                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                            <img class="u-avatar border rounded-circle mr-3" src="<?= $this->Custom->getDp($photo->user->image, 'users') ?>" alt="Image Description">
                        </a>

                    </div>
                    <div class="media-body mb-3">
                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                            <span class="d-block mb-0"><?= ucfirst($photo->user->firstname) . " " . ucfirst(substr($photo->user->lastname, 0, 1)) ?></span>
                        </a>
                        <small class="d-block txt-12lt text-graylt text-left">Traveler photo submitted
                            <?= $this->Custom->niceDateMonthDayYear($photo->created) ?>.</small>
                    </div>
                </div>
                <!-- End Author -->
                <p class="small text-left mt-2 ml-2 mb-5"><q><?= $photo->caption ?></q></p>
            </div>
        </div>
    </div>
</div>