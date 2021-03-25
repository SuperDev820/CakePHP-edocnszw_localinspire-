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

            <h4 class="bold">Call to Action Button</h4>
            <div class="infobox mb-4">Attract more customers with a call to action button! Click the edit button below to edit how it appears on your page.</div>

            <?php if (empty($active_business->cta)) { ?>

              <div class="mt-5 mb-3 bold">This is an example of how it will look on your listings page.</div>

              <div class="mb-5">
                <div class="col-md-12 card p-3 bg-light">
                  <div style="card" class="text-dark">
                    <div class="row">
                      <div class="col-md-9" style="width:70%"><i class="fa fa-bullhorn font24 text-primary" aria-hidden="true"></i> &nbsp; &nbsp; <b>Book with us now and save!</b> </div>
                      <div class="col-md-3 text-right" style="width:30%"><button type="button" class="btn btn-sm btn-cta bold">Book Now</button></div>
                    </div>
                  </div>
                </div>
              </div>

              <p>This is not yet live, to make this live on your business listings page you must click the edit button below to edit how it appears on your page and to make it active, you can edit it at any time to change offers or tweek the text.</p>

            <?php } else { ?>
              <div class="mb-5">
                <div class="col-md-12 card p-3 bg-light">
                  <div style="card" class="text-dark">
                    <div class="row">
                      <div class="col-md-9" style="width:70%"><i class="fa fa-bullhorn font24 text-primary" aria-hidden="true"></i> &nbsp; &nbsp; <b><?= $active_business->cta->text ?></b> </div>
                      <div class="col-md-3 text-right" style="width:30%"><a href="<?= $active_business->cta->link ?>" target="_blank" class="btn btn-sm btn-cta bold"><?= $active_business->cta->btn_text ?></a></div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>


            <div class="mt-6">

              <label class="control-label"></label>
              <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'editCallToAction']); ?>" class="btn btn-sm btn-primary bold">Edit call to action button</a>


            </div>
            </form>
            <BR>
          </div>
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