
<!-- Content Section -->
<div class="bg-light">
  <main>
    <div class="container space-2">
      <div class="row">
        <div class="col-lg-3 mb-9 mb-lg-0">
          <?= $this->element('bizsidebar'); ?>
        </div>
        <div class="col-lg-9 mb-9 mb-lg-0">
          <div class="card p-4">
            <div class="container">
              <div class="row mb-3">
                <div class="col-sm-4">
                  <h4 class="bold">Photos</h4>
                </div>

                <div class="col-sm-8 text-right"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addPhotos', $active_business->id, \Cake\Utility\Text::slug(strtolower($active_business->name))]); ?>" class="btn btn-sm btn-primary bold"> Add photos</a>

                </div>
              </div>
            </div>


            <div class="infobox mb-4">Welcome to your photos. You can easily manage all your photos that you've added or photos that your customers have added that appear on your inspired listings page.</div>




            <div class="bold mt-3 mb-2">Primary business photo</div>

            <div class="row">
              <div class="col-md-4">
                <?= $this->element('primary_photo_block') ?>
              </div>


            </div>
            <hr class="mb-5">

            <div class="bold mt-3 mb-2">Your added photos <span class="small">Photo Gallery</span></div>
            <div class="row  mb-5">
              <?php if (!empty($all_my_photos)) { ?>
                <?php foreach ($all_my_photos as $key => $photo) { ?>
                  <?php $photo_folder = !empty($photo->business_id) ? 'businesses' : 'reviews' ?>
                  <?php $random_id_target =  mt_rand(100000, 999999); ?>
                  <?php $is_review_photo =  empty($photo->business_id) ? "1" : "0"; ?>
                  <div class="col-md-4 mb-5 ">
                    <div class="js-slide card border-0 shadow-sm mb-3">
                      <div class="position-relative">
                        <div class="card-img-top" style="background-image:url(<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>"></div>
                        <div style="background-color: rgba(0,0,0,0.5);border-top-right-radius:8px" class="position-absolute right-1 bottom-0 left-0 p-4">
                          <span class="h6 text-white"><i class="fas fa-thumbs-up mr-1"></i> <?= $photo->helpful_count ?> &nbsp;helpful votes</span>
                        </div>
                      </div>
                      <div class="card-body p-4">
                        <div class="media align-items-center text-graylt">
                          <div class="u-sm-avatar mr-2">
                            <i class="fas fa-building fa-2x"></i>
                          </div>
                          <div class="media-body txt-12lt bold">
                            <span>Owner</span> Added
                          </div>
                          <div class="media-body text-right">
                            <small class="small">
                              <!-- Settings Dropdown -->
                              <div class="position-relative">
                                <a id="ownerphotoSettingsDropdown1<?= $random_id_target ?>Invoker" class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="javascript:;" role="button" aria-controls="ownerphotoSettingsDropdown1<?= $random_id_target ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#ownerphotoSettingsDropdown1<?= $random_id_target ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                  <span class="fas fa-ellipsis-h btn-icon__inner"></span>
                                </a>

                                <div id="ownerphotoSettingsDropdown1<?= $random_id_target ?>" class="dropdown-menu dropdown-unfold dropdown-menu-right" aria-labelledby="ownerphotoSettingsDropdown1<?= $random_id_target ?>Invoker" style="min-width: 160px;">
                                  <a class="dropdown-item set_as_primary" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Set as primary</a>
                                  <?php if (!$photo->slide) { ?>
                                    <a class="dropdown-item add_to_slide" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Add to slide</a>
                                  <?php } else { ?>
                                    <a class="dropdown-item remove_from_slide" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Remove from slide</a>
                                  <?php } ?>
                                </div>
                              </div>
                              <!-- End Settings Dropdown -->
                            </small>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="col-md-12">

                  <div class="card pt-3 mb-4 text-center pb-4 ">
                    <i class="fas fa-images fa-3x"></i>
                    <h5>
                      <h4 class="bold">
                        You haven't added any business photos yet</h4>
                    </h5>
                  </div>
                </div>
              <?php } ?>
            </div>
            <hr class="">
            <div class="bold mb-2">User added photos <span class="small">Photo Gallery</span></div>
            <div class="row  mb-5">
              <?php if (!empty($all_business_photos_unsorted)) { ?>
                <?php foreach ($all_business_photos_unsorted as $key => $photo) { ?>
                  <?php $photo_folder = !empty($photo->business_id) ? 'businesses' : 'reviews' ?>
                  <?php $random_id_target =  mt_rand(100000, 999999); ?>
                  <?php $is_review_photo =  empty($photo->business_id) ? "1" : "0"; ?>
                  <div class="col-md-4 mb-5 ">
                    <div class="js-slide card border-0 shadow-sm mb-3">
                      <div class="position-relative">

                        <div class="card-img-top" style="background-image:url(<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>"></div>

                        <div style="background-color: rgba(0,0,0,0.5);border-top-right-radius:8px" class="position-absolute right-1 bottom-0 left-0 p-4">
                          <span class="h6 text-white"><i class="fas fa-thumbs-up mr-1"></i> <?= $photo->helpful_count ?> &nbsp;helpful votes</span>
                        </div>
                      </div>
                      <div class="card-body p-4">
                        <div class="media align-items-center text-graylt">
                          <div class=" mr-2">
                            <img class="u-sm-avatar border rounded-circle" src="<?= $this->Custom->getDp($photo->user->image, 'users') ?>" alt="Image Description">
                          </div>
                          <div class="media-body txt-12lt bold">
                            Added by <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $photo->user->username]); ?>"><span><?= $photo->user->name_desc ?></span></a>
                          </div>
                          <div class="media-body text-right">
                            <small class="small">
                              <!-- Settings Dropdown -->
                              <div class="position-relative">
                                <a id="photoSettingsDropdown1<?= $random_id_target ?>Invoker" class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="javascript:;" role="button" aria-controls="photoSettingsDropdown1<?= $random_id_target ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#photoSettingsDropdown1<?= $random_id_target ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                  <span class="fas fa-ellipsis-h btn-icon__inner"></span>
                                </a>

                                <div id="photoSettingsDropdown1<?= $random_id_target ?>" class="dropdown-menu dropdown-unfold dropdown-menu-right" aria-labelledby="photoSettingsDropdown1<?= $random_id_target ?>Invoker" style="min-width: 160px;">
                                  <a class="dropdown-item set_as_primary" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Set as primary</a>
                                  <?php if (!$photo->slide) { ?>
                                    <a class="dropdown-item add_to_slide" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Add to slide</a>
                                  <?php } else { ?>
                                    <a class="dropdown-item remove_from_slide" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Remove from slide</a>
                                  <?php } ?>
                                  <a class="dropdown-item photo_report" href="#" data-photo_id="<?= $photo->id ?>" data-is_review_photo="<?= $is_review_photo ?>">Report photo</a>

                                </div>
                              </div>
                              <!-- End Settings Dropdown -->
                            </small>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="col-md-12">

                  <div class="card pt-3 mb-4 text-center pb-4 ">
                    <i class="fas fa-images fa-3x"></i>
                    <h5>
                      <h4 class="bold">
                        No user added photos at the moment</h4>
                    </h5>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<!-- End Content -->
<?= $this->element('report_photo_modal') ?>
<script>
  $().popover({
    container: 'body'
  })
  $(document).ready(function() {
    $("[rel='tooltip']").tooltip();

    $('.thumbnail').hover(
      function() {
        $(this).find('.caption').slideDown(250); //.fadeIn(250)
      },
      function() {
        $(this).find('.caption').slideUp(250); //.fadeOut(205)
      }
    );
  });
</script>