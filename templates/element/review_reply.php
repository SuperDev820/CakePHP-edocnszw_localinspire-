

<!-- Featured Job Item  -->
<div class="">
  <div class="d-md-flex justify-content-between align-items-center px-0">
    <div class="media align-items-center mb-5 mb-md-0">
      <div class="u-sm-avatar mr-3">
        <a class="bold text-gray" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $business->user->username]); ?>"><img class="after_login_img  u-sidebar--account__toggle-img mr-2 " src="<?= !empty($review->user) ?  $this->Custom->getDp($business->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="height: 100%;"></a>
    </div>
      <div class="media-body">
        <div class="d-inline-block text-darklt txt-15">
            <a class="bold text-darklt" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $business->user->username]); ?>"><?= ucfirst($business->user->firstname) . " " . ucfirst(substr($business->user->lastname, 0, 30)) ?></a>  <span class="text-darklt txt-12lt">─ Business Representative 
        </span></div>
        <span class="d-block text-gray-dark txt-12lt">Responded <?= $this->Custom->niceDateMonthDayYear($review->business_review_replies[0]->created) ?></span>
        
        
      </div>
    </div>

    <div class="text-md-right text-secondary">
     <!-- Icons -->
        <ul class="list-inline mb-0">

            <li class="list-inline-item mr-0">
                <!-- Settings Dropdown -->
                <div class="position-relative">
                    <a id="createProjectSettingsDropdown<?= $review->id ?>Invoker" class="btn btn-sm btn-icon btn-soft-link btn-bg-transparent" href="javascript:;" role="button" aria-controls="createProjectSettingsDropdown<?= $review->id ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#createProjectSettingsDropdown<?= $review->id ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                        <span class="fas fa-ellipsis-h text-grayxlt btn-icon__inner"></span>
                    </a>

                    <div id="createProjectSettingsDropdown<?= $review->id ?>" class="dropdown-menu dropdown-unfold border dropdown-menu-right u-unfold--css-animation u-unfold--hidden fadeOut" aria-labelledby="createProjectSettingsDropdown<?= $review->id ?>Invoker" style="min-width: 120px; animation-duration: 300ms;">

                        <a class="dropdown-item reportownerModal txt-12lt" href="javascript:;" data-review_id="<?= $review->id ?>" data-business_id="<?= $review->business_id ?>">Report this</a>
                    </div>
                </div>
                <!-- End Settings Dropdown -->
            </li>

        </ul>
        <!-- End Icons -->
    </div>
  </div>
<div class="small mb-4 ml-3 mt-3 pl-5 border-left">
<?= nl2br($review->business_review_replies[0]->reply) ?> </div>
  
</div>
<!-- End Featured Job Item -->

       
        
        
        
        
        
        
        
    