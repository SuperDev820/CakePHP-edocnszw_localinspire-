<div class="space8">
    <div class="review-image-gallery-item" style="background-image:url(<?= $this->Custom->getDp($photo->photo, (!empty($is_review_photo) ? 'reviews' : "businesses")) ?>)">
        <a class="gallery gallery_item_<?= $photo->id ?>" href="<?= $this->Custom->getDp($photo->photo, (!empty($is_review_photo) ? 'reviews' : "businesses")) ?>" data-sub-html="#review_photo_side_model_<?= $photo->id ?>" data-src="<?= $this->Custom->getDp($photo->photo, (!empty($is_review_photo) ? 'reviews' : "businesses")) ?>" style="display: block;height: 100%;" data-business_id="<?= $photo->business_id ?>" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= !empty($is_review_photo) ? "1" : "0" ?>"  data-business_gallery="<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($business) ? \Cake\Utility\Text::slug(strtolower($business->name)) : ''), (!empty($business->city) ? $business->city->state->code : ''), (!empty($business) ? $business->id : '')]); ?>"  data-helfulc="<?= !empty($is_review_photo) ? count($photo->helpful_review_photos) : count($photo->helpful_photos) ?>">
        </a>
        <div class="row" id="review_photo_side_model_<?= $photo->id ?>" style="display: none;">

            <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop pr-3 pl-3">
                <!-- Author -->
                <div class="media pr pt-3 pb-1">
                    <div class="u-avatar mr-3">
                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                            <img class="u-avatar border rounded-circle mr-3" src="<?= $this->Custom->getDp($photo->user->image, 'users') ?>" alt="Image Description">
                        </a>
                    </div>
                    <div class="media-body">
                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>">
                            <span class="d-block mb-0"><?= ucfirst($photo->user->firstname) . " " . ucfirst(substr($photo->user->lastname, 0, 1)) ?></span>
                        </a>
                        <small class="d-block txt-12lt text-graylt text-left">Traveler photo submitted
                            <?= $this->Custom->niceDateMonthDayYear($photo->created) ?>.</small>
                    </div>
                </div>
                <!-- End Author -->

                <p class="small text-left mt-2 ml-2 mb-5"><q><?= $photo->caption ?></q></p>


                <!--							<div class="txt-xs mb-5 text-right">Sponsored links &nbsp;&nbsp;<span data-toggle="popover" data-html="true" data-placement="top" data-trigger="hover" data-content="<span class='small'>A business owner paid for this ad. For more information visit our business center.</span>"><i class="fa fa-info-circle" aria-hidden="true"></i></span></div>-->

            </div>

        </div>
    </div>
</div>