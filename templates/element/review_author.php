<div class="row">
    <div class="col-10 px-4">
        <!-- Card -->
        <div class="media">
             <!-- Avatar -->
        <div class="u-avatar position-relative ml-2 mr-3">
          <img class="u-avatar rounded-circle" src="<?= !empty($review->user) ?  $this->Custom->getDp($review->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
          <span class="badge badge-xs badge-outline-success badge-pos badge-pos--bottom-left rounded-circle"></span>
        </div>
        <!-- End Avatar -->
            <div class="media-body mt-2">
                <h6 class="d-inline-block mb-1 font-weight-normal txt-12">
                    <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= ucfirst($review->user->name_desc) ?></a>

                 <?php if (!empty($rec)) { ?>
                       <?= $rec ?>
                       <b>
                            <?php if (isset($isUserActivity)) { ?>
                                <a class="txt-14 text-dark bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->business->id]); ?>"><?= $review->business->name ?></a>
                            <?php } else { ?>
                                <?= $review->business->name ?>
                            <?php } ?>
                        </b> 
                    <?php } else { ?>
                        left a tip on <?= $this->Custom->niceDateMonthDayYear($review->created) ?>
                    <?php } ?>
                   <!--- <?= $this->Custom->niceDateMonthDayYear($review->created) ?>--->
                    
                    
                    <span class="d-block txt-12lt text-gray-dark"><i class="fas fa-map-marker-alt txt-12lt text-gray-dark"></i> <?= !empty($review->user->city) ? $review->user->city->name . ", " . strtoupper($review->user->city->state->code) : ""; ?>
                        &bull; <?= $this->Custom->userContributions($review->user) ?>
                        contributions
                    </span>
                    
                    
                </h6>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <div class="col-2 text-right pr-4">
        <!-- Icons -->
        <ul class="list-inline mb-0">

            <li class="list-inline-item mr-0">
                <!-- Settings Dropdown -->
                <div class="position-relative">
                    <a id="createProjectSettingsDropdown<?= ((isset($tips) and $tips == true) ? "tips" : "review") . $review->id ?>Invoker" class="btn btn-sm btn-icon btn-soft-link btn-bg-transparent" href="javascript:;" role="button" aria-controls="createProjectSettingsDropdown<?= ((isset($tips) and $tips == true) ? "tips" : "review") . $review->id ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#createProjectSettingsDropdown<?= ((isset($tips) and $tips == true) ? "tips" : "review") . $review->id ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                        <span class="fas fa-ellipsis-h text-dark btn-icon__inner"></span>
                    </a>

                    <div id="createProjectSettingsDropdown<?= ((isset($tips) and $tips == true) ? "tips" : "review") . $review->id ?>" class="dropdown-menu dropdown-unfold border dropdown-menu-right u-unfold--css-animation u-unfold--hidden fadeOut" aria-labelledby="createProjectSettingsDropdown<?= ((isset($tips) and $tips == true) ? "tips" : "review") . $review->id ?>Invoker" style="min-width: 120px; animation-duration: 300ms;">

                        <a class="dropdown-item reportreview txt-12lt" href="javascript:;" data-review_id="<?= $review->id ?>" data-business_id="<?= $review->business_id ?>">Report this</a>
                    </div>
                </div>
                <!-- End Settings Dropdown -->
            </li>

        </ul>
        <!-- End Icons -->
    </div>
</div>