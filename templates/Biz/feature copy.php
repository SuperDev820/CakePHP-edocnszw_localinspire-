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

                          <h4 class="bold">Create your Featured Ad</h4>
                          <div class="infobox mb-4">Attract more customers with featured ads!</div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="bold mt-3 mb-2">Business photo <br>
                                      <!-- <strong> <a target="_blank" href="<?php //echo $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'photos']); 
                                                                                ?>">Click here to change this</a></strong> -->
                                  </div>
                                  <?php //echo $this->element('primary_photo_block') 
                                    ?>

                                  <style>
                                      .imgp,
                                      .image_picker_image {
                                          /* width: 300px; */
                                          width: 100%;
                                      }

                                      .imgp--width2 {
                                          width: 400px;
                                      }

                                      .thumbnails li {
                                          position: static !important;
                                          left: initial !important;
                                          top: initial !important;
                                          padding: 0;
                                          height: 100px;
                                      }

                                      /* .thumbnails .thumbnail{
                                          height: 100px;
                                      } */
                                  </style>
                                  <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/image-picker/image-picker.css">
                                  <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/image-picker/image-picker.min.js"></script>
                                  <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/masonry/masonry.pkgd.min.js"></script>
                                  <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/masonry/imagesloaded.pkgd.min.js"></script>

                                  <select class="image-picker masonry show-html">

                                      <?php foreach ($all_business_photos as $key => $photo) { ?>
                                          <?php $photo_folder = !empty($photo->business_id) ? 'businesses' : 'reviews' ?>
                                          <option class="imgp" data-img-src="<?= $this->Custom->getDp($photo->photo, $photo_folder) ?>" value="<?= $photo->id ?>">Cute Kitten 1</option>

                                      <?php } ?>

                                  </select>
                                  <script>
                                      $(document).ready(function() {

                                          $(".image-picker").imagepicker();
                                          var container = jQuery(".image-picker.masonry").next("ul.thumbnails");
                                          container.imagesLoaded(function() {
                                              //   $('.rotation ul').addClass('image_rotation');

                                              // $('ul.thumbnails').addClass('row');
                                              container.masonry({
                                                  itemSelector: "li",
                                                  columnWidth: 200
                                              });

                                              $('ul.thumbnails').addClass('row');
                                              $('ul.thumbnails li').addClass('col-md-3');
                                          });
                                          //   https: //rvera.github.io/image-picker/ for options
                                          //   $(".image-picker").imagepicker({
                                          //       initialized: function(imagePicker) {
                                          //           //   alert("done");

                                          //           //   $('.masonry').masonry({
                                          //           imagePicker.masonry({
                                          //               // options
                                          //               itemSelector: '.imgp',
                                          //               //   columnWidth: 200
                                          //           });
                                          //       }
                                          //   });

                                          //   setTimeout(function() {

                                          //   https://masonry.desandro.com/
                                          //   $('.masonry').masonry({
                                          //       // options
                                          //       itemSelector: '.imgp',
                                          //       columnWidth: 200
                                          //   });
                                          //   }, 2000);


                                      });
                                  </script>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">

                                  <?php if (!empty($featuredReview)) { ?>
                                      <div class="bold mt-3 mb-2">Featured Review <br><strong> <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'reviews']); ?>">Click here to change this</a></strong></div>

                                      <!-- <div class="bold mt-3 mb-2"><strong> <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($featuredReview->business->name)), $featuredReview->business->city->state->code, $featuredReview->id]); ?>"><?= $featuredReview->title ?></a></strong></div> -->
                                      <?= $this->element('review_block', ['review' => $featuredReview, 'nolinkurl' => false, 'business' => $active_business]) ?>
                                      <?= $this->element('review_scripts') ?>
                                  <?php } else { ?>
                                      <?php echo $this->Form->create($active_business, ['id' => 'biz_form', 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>
                                      <div>
                                          <h5 style="font-weight:bold;font-size:14px">Describe your Business <span style="font-weight: normal;font-size:13px;color:#888">(<span id="description_len_preview">0</span> of 500 characters)</span></span></h5>

                                          <span style="font-size:12px"> Tell us what's great about your business, entice people to want to know more. (No links, phone numbers, or extra caps allowed)</span>
                                          <!-- <textarea class="form-control" rows="4" cols="50" value="">Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...</textarea> -->

                                          <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control desc_control', 'placeholder' => 'Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...', 'autocomplete' => 'off', "required", 'id' => 'description', "maxlength" => "500"]) ?>
                                      </div>

                                      <!-- <button type="button" class="btn btn-primary regbutton btn-lg bold">Continue</button> -->
                                      <?= $this->Form->button(__('Save Featured Ad'), ['type' => 'submit', 'value' => "Save Announcement", 'class' => 'btn btn-sm btn-primary bold btn-lg mt-3', 'style' => '']); ?>

                                      <style>
                                          .redbold {
                                              font-weight: bold;
                                              color: #D12429;
                                              margin-top: 35px;
                                              margin-bottom: 15px;
                                          }
                                      </style>
                                      <?= $this->Form->end() ?>


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


                                  <div>
                                      <h4 class="redbold">Your featured ad will appear on:</h4>

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


                              </div>

                          </DIV>
                          <div style="margin-top:50px;font-size:11px">Disclaimer: There are no contracts and this offer can be discontinued or changed at anytime.</div>
                      </div>
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