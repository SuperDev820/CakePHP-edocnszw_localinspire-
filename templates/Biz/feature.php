  <style>
      .tooltip-inner {
          padding: 9px !important;
          max-width: 450px;
          /* set this to your maximum fitting width */
          width: inherit;
          /* will take up least amount of space */
      }
  </style>
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
                          <?php echo $this->Form->create($active_business, ['id' => 'biz_form', 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

                          <h4 class="bold">Create your Featured Ad</h4>
                          <div class="infobox mb-4">Attract more customers with featured ads!</div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="bold mt-3 mb-2">Select Featured Photo <br>
                                      <!-- <strong> <a target="_blank" href="<?php //echo $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'photos']); 
                                                                                ?>">Click here to change this</a></strong> -->
                                  </div>
                                  <?php //echo $this->element('primary_photo_block') 
                                    ?>

                                  <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/bootstrap-image-checkbox/dist/css/bootstrap-image-checkbox.min.css">
                                  <!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/image-picker/image-picker.min.js"></script>
                                  <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/masonry/masonry.pkgd.min.js"></script>
                                  <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/masonry/imagesloaded.pkgd.min.js"></script>  -->
                                  <div class="row">
                                      <?php foreach ($all_business_photos as $key => $photo) { ?>
                                          <?php $photo_folder = !empty($photo->business_id) ? 'businesses' : 'reviews' ?>
                                          <?php $is_review_photo = empty($photo->business_id) ? '1' : '' ?>
                                          <?php $random_id_target =  mt_rand(100000, 999999); ?>

                                          <div class="col-md-3">
                                              <div class="custom-control custom-radio image-checkbox mb-2">
                                                  <input type="radio" data-is_review_photo="<?= $is_review_photo ?>" value="<?= $photo->id ?>" class="custom-control-input ck2" id="<?= $photo->id . $random_id_target ?>" name="ck2">
                                                  <label class="custom-control-label" for="<?= $photo->id . $random_id_target ?>">
                                                      <img src="<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>" alt="#" class="img-fluid img-thumbnail card-img-top">
                                                  </label>
                                              </div>
                                          </div>

                                      <?php } ?>
                                  </div>
                              </div>

                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <?php if (!empty($active_business->review_count)) {
                                    ?>
                                      <?php //if (1 == 2) { 
                                        ?>
                                      <div class="bold mt-3 mb-2">Select Featured Review
                                          <!--<br> <strong> <a target="_blank" href="<?php //echo $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'reviews']); 
                                                                                        ?>">Click here to change this</a></strong> -->
                                      </div>
                                      <div class="row">
                                          <?php echo $this->element('reviews_table_mini', ['userid' => null, 'showUser' => true, 'ajax' => true, 'show_edit' => true, 'show_remove' => false, "idtouse" => "reviews_table", "record_name" => "reviews", 'business_id' => $active_business->id]) ?>

                                      </div>
                                  <?php } else { ?>

                                      <div>
                                          <h5 style="font-weight:bold;font-size:14px">Describe your Business <span style="font-weight: normal;font-size:13px;color:#888">(<span id="description_len_preview">0</span> of 500 characters)</span></span></h5>

                                          <span style="font-size:12px"> Tell us what's great about your business, entice people to want to know more. (No links, phone numbers, or extra caps allowed)</span>
                                          <!-- <textarea class="form-control" rows="4" cols="50" value="">Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...</textarea> -->

                                          <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control desc_control', 'placeholder' => 'Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...', 'autocomplete' => 'off', "required", 'id' => 'description', "maxlength" => "500"]) ?>
                                      </div>

                                      <!-- <button type="button" class="btn btn-primary regbutton btn-lg bold">Continue</button> -->


                                      <style>
                                          .redbold {
                                              font-weight: bold;
                                              color: #D12429;
                                              margin-top: 35px;
                                              margin-bottom: 15px;
                                          }
                                      </style>


                                      <script>
                                          $(document).ready(function() {

                                              $("#description_len_preview").text($("#description").val().length);
                                              jQuery(document).on('keyup', '.desc_control', function(e) {
                                                  e.preventDefault();
                                                  $("#description_len_preview").text($("#description").val().length);
                                              });

                                          });
                                      </script>
                                  <?php } ?>
                                  <br>
                                  <?= $this->Form->button(__('Save Featured Ad'), ['type' => 'submit', 'value' => "Save Announcement", 'class' => 'btn btn-soft-primary transition-3d-hovery bold btn-lg mt-3', 'style' => '', 'id' => 'savead']); ?>
                              </div>

                          </div>
                          <?= $this->Form->end() ?>
                      </div>
                      <div class="row">
                          <div class="col-md-8">

                              <!-- <h4 class="redbold">Your featured ad will appear on:</h4> -->
                              <div class="mt-5 mb-3 bold">Your featured ad will appear on:</div>

                              <b>Home page for your city</b>
                              <br>
                              We'll show your ad at the top on the home page for your city as a featured business.
                              <br><br>
                              <b>Search results pages</b>
                              <br>
                              We'll show your ad above the natural serch results for your keyword and city.

                              <br><br>
                              <b>Competitors pages</b>
                              <br>
                              We'll show your ad on your competitors business page based on category.


                              <br><br>
                              <b>Competitors images</b>
                              <br>
                              We'll show your ad at the bottom right of competitors image popup as a featured business.

                              <br><br>
                              <b>Members dashboard</b>
                              <br>
                              We'll show your ad at the bottom of the page in the members dashboard for your city.


                          </div>
                          <div class="col-md-4">
                              <div class="mt-5 mb-3 bold">How your Ad will look</div>
                              <?= $this->element('ad_main', ['business' => $active_business, 'featured_ad' => $featured_ad]) ?>
                          </div>
                      </div>
                      <div style="margin-top:50px;font-size:11px">Disclaimer: There are no contracts and this offer can be discontinued or changed at anytime.</div>
                  </div>
              </div>
          </div>
      </main>
  </div>
  <!-- End Content -->


  <script>
      $().popover({
          container: 'body'
      })

      var selectedrow;
      var selectedreview = false;
      <?php if (!empty($featured_ad) and !empty($featured_ad->business_review_id)) { ?>
          selectedreview = "<?= $featured_ad->business_review_id ?>";
      <?php } ?>

      var image_id = false;
      var is_review_photo = '';
      <?php if (!empty($featured_ad) and !empty($featured_ad->business_photo_id)) { ?>
          image_id = "<?= $featured_ad->business_photo_id ?>";
      <?php } ?>
      <?php if (!empty($featured_ad) and !empty($featured_ad->business_review_photo_id)) { ?>
          image_id = "<?= $featured_ad->business_review_photo_id ?>";
          is_review_photo = '1';
      <?php } ?>



      function showBizPreview() {
          if (image_id) {
              $.ajax({
                  beforeSend: function(xhr) {
                      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                      xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                      xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                  },
                  type: "POST",
                  url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'showBizPreview']); ?>",
                  data: {
                      'business_id': '<?= $active_business->id ?>',
                      'image_id': image_id,
                      'is_review_photo': is_review_photo
                  },
                  success: function(data) {
                      unblock();
                      $('.biz_preview').html(data);
                  },
                  error: function(error) {
                      console.log(error);
                      unblock();
                  }
              });
          }
      }

      function showReviewPreview() {
          var description = $("#description").val();
          if (selectedreview || description) {
              $.ajax({
                  beforeSend: function(xhr) {
                      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                      xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                      xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                  },
                  type: "POST",
                  url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'showReviewPreview']); ?>",
                  data: {
                      'selectedreview': selectedreview,
                      'description': description,
                  },
                  success: function(data) {
                      unblock();
                      $('.review_preview').html(data);
                  },
                  error: function(error) {
                      console.log(error);
                      unblock();
                  }
              });
          }

      }

      function saveFeaturedAd() {
          var description = $("#description").val();
          <?php if (!empty($active_business->review_count)) {
            ?>
              <?php //if (1 == 2) { 
                ?>

              if (!selectedreview) {
                  toastr.error("Please select a review");
                  return false;
              }
          <?php } else { ?>
              if (!description) {
                  toastr.error("Please add a description for your business");
                  return false;
              }
          <?php } ?>

          if (!image_id) {
              toastr.error("Please choose an image for your Ad");
              return false;
          }

          block();
          $.ajax({
              beforeSend: function(xhr) {
                  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                  xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
              },
              type: "POST",
              url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'saveFeaturedAd']); ?>",
              data: {
                  'business_id': '<?= $active_business->id ?>',
                  'selectedreview': selectedreview,
                  'image_id': image_id,
                  'description': description,
                  'is_review_photo': is_review_photo
              },
              success: function(data) {
                  unblock();
                  if (data.success) {
                      toastr.success("Your featured Ad has been saved");
                  }
              },
              error: function(error) {
                  console.log(error);
                  unblock();
              }
          });
      }
      $(document).ready(function() {

          jQuery(document).on('change', '#description', function(e) {
              showReviewPreview();
          });
          jQuery(document).on('change', '.ck2', function(e) {
              var radio = $("input[name='ck2']:checked");

              image_id = radio.val();
              is_review_photo = radio.data('is_review_photo');
              showBizPreview();
              showReviewPreview();
              //   console.log(radioVal);
          });
          jQuery(document).on('click', '.review_row', function(e) {
              var ids = $.map(reviews_table_table.rows('.selected').data(), function(item) {
                  selectedreview = $(item[0]).data('reviewid');
                  return $(item[0]).data('reviewid');
              });
              showReviewPreview();
          });

          jQuery(document).on('click', '#savead', function(e) {
              e.preventDefault();
              saveFeaturedAd();
          });


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