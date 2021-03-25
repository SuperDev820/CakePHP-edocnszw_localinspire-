<?php if (!empty($featured_ads)) { ?>
    <?php foreach ($featured_ads as $key => $ad) { ?>
        <div class="">
            <div class="biz_preview">
                <?= $this->element('ad_body', ['business' => $ad->business, 'selectedImage' => $this->Custom->getSponsoredPhotoUrl($ad->business)]) ?>
            
                <?= $this->element('ad_review', ['business' => $ad->business, 'review' => (!empty($ad->business_review)) ? $ad->business_review : null]) ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>