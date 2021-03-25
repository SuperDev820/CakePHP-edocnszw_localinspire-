<div class="">
    <div class="">
        <div class="d-flex">
            <div class=""> <a class="" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">
    <img style="height: 65px; width:65px" class="rounded" src="<?= //$selectedImage 
    $this->Custom->getBusinessPhotoUrl($business, false, $selectedImage) ?>" alt="<?= $business->name ?>"> </div>
    
            <div class="ml-3" style="width:590px">
                <h2 class="h6 bold mb-0"><?= $business->name ?></h2> 
                
            
                 <ul class="list-inline text-white star_size11 mb-1">
                <?= $this->element('stars_count', ['rating' => $business->average_rating]) ?>
                <span class="txt-12lt text-secondary"> &nbsp;&nbsp;<?= $business->review_count ?>&nbsp; reviews</span></ul>
                
          

<!---
<a class="card card-text-dark border-0 shadow-sm" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">
    <img class="card-img-top biz_image" src="<?= //$selectedImage 
    $this->Custom->getBusinessPhotoUrl($business, false, $selectedImage) ?>" alt="<?= $business->name ?>">
    <div class="card-body p-2">
        <h2 class="h6 mb-0"><span class="badge badge-warning text-white small">Ad</span> <?= $business->name ?></h2>
        <small class="d-block text-secondary"><?= $this->Custom->displayCategoriesAndSubcategories($business, true) ?></small>
       <div class="small">
            <ul class="list-inline text-white star_size18 mb-2">
                <?= $this->element('stars_count', ['rating' => $business->average_rating]) ?>
                <span class="small text-secondary"> &nbsp;&nbsp;<?= $business->review_count ?>&nbsp; reviews</span>
            </ul>            
        </div>
    </div>
</a>--->