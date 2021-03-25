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
            <?= $this->element('announcement_form') ?>
            <BR>
          </div>
          <BR>
        </div>
      </div>
    </div>
  </main>
</div>
<!-- End Content -->