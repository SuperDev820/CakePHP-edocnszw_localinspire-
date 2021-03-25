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


            <h4 class="bold">Edit your special</h4>
            <div class="infobox mb-6"> Visitors will see your special on your business listing and other places depending on the offer. Give them a reason to visit and keep coming back, or set it for when your business is slow.</div>

            <?= $this->element('offers_form') ?>
            <BR>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<!-- End Content -->



<!-- Begin Print code modal -->
<?php //echo $this->element('print_code_modal') 
?>
<!-- End Print code modal -->
<!-- Begin Print ONLY Offer Script -->


<!-- End Print ONLY Offer Script -->
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