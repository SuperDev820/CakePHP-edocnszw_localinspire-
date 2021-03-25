<style>
  .tooltip-inner {
    padding: 5px !important;
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
            <div class="container">
              <div class="row mb-3">
                <div class="col-sm-4">
                  <h4 class="bold">Special Offers</h4>
                </div>

                <div class="col-sm-8 text-right"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'addSpecialOffer']); ?>" class="btn btn-sm btn-primary bold"> Add a special offer</a>

                </div>
              </div>
            </div>


            <div class="infobox mb-4">Attract more customers with a special offer! Special offers work great to get customers to come in on your slow days or times.</div>

            <?php if (!empty($offers_total_count)) { ?>

              <table class="table table-light">
                <thead>
                  <tr>
                    
                    <th scope="col">Title</th>
                    <th scope="col">Audience</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Stop Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($offers as $key => $offer) { ?>
                    <tr>
                     
                      <td class="align-middle text-text-graylt">
                        <!-- <?= $this->Custom->getOfferIcon($offer) ?>  -->
                        <small class="d-block"><?= $offer->title ?></small>
                      </td>
                      <td class="align-middle text-secondary small">
                        <?= $this->Custom->getOfferAudience($offer) ?>
                      </td>
                      <td class="align-middle text-secondary small">
                        <!-- <span class="fas fa-chair mr-2"></span> -->
                        <?= $this->Custom->readableTimestamp2($offer->start_date) ?>
                      </td>
                      <td class="align-middle text-secondary small">
                        <!-- <span class="far fa-eye mr-2"></span> -->
                        <?= $this->Custom->readableTimestamp2($offer->stop_date) ?>
                      </td>
                      <td scope="row" class="align-middle">
                        <?php if ($offer->active) { ?>
                          <span class="badge badge-success">Active</span>
                        <?php } else { ?>
                          <span class="badge badge-danger">Paused</span>
                        <?php } ?>

                      </td>

                      <td class="align-middle">

                        <?= $this->Form->postLink(__(' <span class="fas fa-play btn-icon__inner"></span>'), ['action' => 'activateOffer', $offer->id], ['confirm' => __('Are you sure you want to activate # {0}?', $offer->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Activate", 'class' => 'btn btn-xs btn-icon btn-soft-success', 'escape' => false]) ?>

                        <?= $this->Form->postLink(__(' <span class="fas fa-ban btn-icon__inner"></span>'), ['action' => 'pauseOffer', $offer->id], ['confirm' => __('Are you sure you want to pause # {0}?', $offer->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Pause", 'class' => 'btn btn-xs btn-icon btn-soft-danger', 'escape' => false]) ?>


                        <a class="btn btn-xs btn-icon btn-soft-secondary" href="<?= $this->Url->build(['action' => 'editSpecialOffer', $offer->id]); ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                          <span class="fas fa-pen btn-icon__inner"></span>
                        </a>
                        <?= $this->Form->postLink(__(' <span class="fas fa-trash-alt btn-icon__inner"></span>'), ['action' => 'deleteOffer', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete", 'class' => 'btn btn-xs btn-icon btn-soft-danger', 'escape' => false]) ?>
                      </td>
                    </tr>

                  <?php } ?>

                </tbody>
              </table>

              <br>

              <?php if ($showOffersPagination) { ?>
                <?= $this->element('pagination_block', ['model' => 'Offers', 'showPageBool' => $showOffersPagination, 'recordname' => "offers"]) ?>

              <?php } ?>
            <?php } else { ?>
              <!-- <div class="col-md-12"> -->

              <div class="card pt-3 mb-4 text-center pb-4 ">
                <i class="fas fa-images fa-3x"></i>
                <h5>
                  <h4 class="bold">
                    You haven't added any offers yet</h4>
                </h5>
              </div>
              <!-- </div> -->
            <?php } ?>


            <BR>
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