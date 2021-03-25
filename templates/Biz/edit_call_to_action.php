<style>
  .tooltip-inner {
    padding: 9px !important;
    max-width: 450px;
    /* set this to your maximum fitting width */
    width: inherit;
    /* will take up least amount of space */
  }

  .custom-checkbox .custom-control-input:indeterminate~.custom-control-label::before {
    /* background-color: #008ae6; */
    background-color: #e7eaf3;
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
          <?= $this->Form->create($cta, ['class' => '', 'enctype' => 'multipart/form-data', 'id' => 'cta_form']) ?>
          <div class="card p-4">

            <h4 class="bold">Create your Call to Action Button</h4>
            <div class="infobox mb-4">Attract more customers with a call to action button!</div>

            <div class="bold mb-2">Pick your call to action text that best fits your need.</div>
            <div class="row mb-4">
              <div class="col-md-4 mb-1">

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="bn" value="Book Now" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="bn">
                    Book Now
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="cn" value="Call Now" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="cn">
                    Call Now
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="gq" value="Get Quote" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="gq">
                    Get Quote
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="cu" value="Contact Us" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="cu">
                    Contact Us
                  </label>
                </div>


              </div>
              <div class="col-md-4 mb-1">
                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="sa" value="Schedule Appointment" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="sa">
                    Schedule Appointment
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="vu" value="Visit Us" name="btn_text_options" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="vu">
                    Visit Us
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="en" value="Enroll Now" name="btn_text_options" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="en">
                    Enroll Now
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="vm" value="View Menu" name="btn_text_options" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="vm">
                    View Menu
                  </label>
                </div>
              </div>

              <div class="col-md-4 mb-1">
                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="bt" value="Buy Tickets" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="bt">
                    Buy Tickets
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="gc" value="Get Coupon" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="gc">
                    Get Coupon

                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="gs" value="Get Special" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="gs">
                    Get Special
                  </label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input type="radio" class="custom-control-input" id="mr" value="Make Reservations" name="btn_text_options">
                  <label class="custom-control-label txt-12 pt-1" for="mr">
                    Make Reservations
                  </label>
                </div>

              </div>
            </div>
            <div class="form-group mb-4">
              <label class="bold mb-0" for="btn_text">Call to action button text <span class="small">(<span id="btntext_len_preview">0</span> of 20 characters</span>)</label>
              <div class="mb-2 txt-12lt text-graylt">This field is required.</div>
              <!-- <input type="email" class="form-control" id="at" placeholder="Book with us now and save!"> -->
              <?= $this->Form->control('btn_text', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control cta_control', 'placeholder' => 'Book', 'required', "maxlength" => "20",  'id' => 'btn_text']) ?>
            </div>

            <div class="form-group mb-4">
              <label class="bold mb-0" for="text">Call to Action Text <span class="small">(<span id="text_len_preview">0</span> of 50 characters)</span></label>
              <div class="mb-2 txt-12lt text-graylt">This field is required.</div>
              <!-- <input type="email" class="form-control" id="at" placeholder="Book with us now and save!"> -->
              <?= $this->Form->control('text', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control cta_control', 'placeholder' => 'Book with us now and save!', "maxlength" => "50", 'required',  'id' => 'text']) ?>
            </div>


            <div class="form-group">
              <label class="bold mb-0" for="link">Link to your desired location <span rel="tooltip" data-html="true" data-container="body" title="Add the url where your visitors can get your offer." data-placement="top" class="txt-12lt cursor"> <i class="fa fa-info-circle" aria-hidden="true"></i></span> </label>
              <!-- <input type="email" class="form-control" id="sol" placeholder="http://www.mysite.com/linktoyouroffer"> -->
              <?= $this->Form->control('link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control cta_control', 'placeholder' => 'http://www.mysite.com/linktoyouroffer', 'type' => 'url', 'required',  'id' => 'link']) ?>
            </div>


            <div class="custom-control custom-checkbox mt-3">
              <!-- <input type="checkbox" class="custom-control-input" id="stylishCheckbox"> -->
              <?= $this->Form->checkbox('active', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'custom-control-input', $cta->active == false ? '' : 'checked' => "checked", "id" => "stylishCheckbox"]) ?>
              <label class="custom-control-label" for="stylishCheckbox">
                Checking this box makes this Call to Action live on your listing, and means you agree to the guidelines.
              </label>
            </div>

            <div class="mt-5 mb-3 bold">How your Call to Action offer will look</div>


            <div class="mb-5">
              <div class="col-md-12 card p-3 bg-light">
                <div style="card" class="text-dark">
                  <div class="row">
                    <div class="col-md-9" style="width:70%"><i style="font-size:22px;color:#48AAE6" class="fa fa-bullhorn" aria-hidden="true"></i> &nbsp; &nbsp; <b id="text_preview">Book with us now and save!</b> </div>
                    <div class="col-md-3 text-right" style="width:30%"><a href="#" class="btn bold btn-cta btn-sm" id="btn_preview">Book Now</a></div>
                  </div>
                </div>
              </div>
            </div>


            <div class="mt-3">

              <label class="control-label"></label>
              <!-- <input class="btn btn-sm btn-primary bold" type="button" value="Save Call to Action"> -->
              <?= $this->Form->button(__('Save Call to Action'), ['type' => 'submit', 'value' => "Save Call to Action", 'class' => 'btn btn-sm btn-primary bold', 'style' => '']); ?>
              <span></span>
              <input class="btn btn-link" type="button" onclick="goBack()" value="Cancel">
              <script>
                function goBack() {
                  window.history.back();
                }
              </script>
            </div>
            </form>
            <BR>
          </div>
          <?= $this->Form->end() ?>
          <BR>
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

  function updatePreview() {
    $("#text_len_preview").text($("#text").val().length);
    $("#btntext_len_preview").text($("#btn_text").val().length);
    if ($("#btn_text").val()) {
      $("#btn_preview").text($("#btn_text").val());
    }
    if ($("#text").val()) {
      $("#text_preview").text($("#text").val());
    }
  }
  $(document).ready(function() {
    $('input[type=radio][name=btn_text_options]').change(function() {
      $("#btn_text").val(this.value);
      updatePreview();
    });

    jQuery(document).on('keyup', '.cta_control', function(e) {
      e.preventDefault();
      updatePreview();
    });


    jQuery(document).on('change', '.cta_control', function(e) {
      e.preventDefault();
      updatePreview();
    });


    setTimeout(function() {
      updatePreview();
    }, 2000);


  });
</script>