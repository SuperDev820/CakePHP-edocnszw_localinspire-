   <div class="biz_preview">
       <?= $this->element('ad_body', ['business' => $business, 'selectedImage' => $this->Custom->getBusinessAdPhoto($featured_ad)]) ?>
   </div>
   <div class="row review_preview">
       <?= $this->element('ad_review', ['business' => $business, 'review' => (!empty($featured_ad) ? $featured_ad->business_review : (!empty($business->ad->business_review) ? $business->ad->business_review : null))]) ?>
   </div>