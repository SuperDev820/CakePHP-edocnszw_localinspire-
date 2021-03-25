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
                  <h4 class="bold">Announcements</h4>
                </div>

                <div class="col-sm-8 text-right"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'addAnnouncement']); ?>" class="btn btn-sm btn-primary bold"> Add an announcement</a>

                </div>
              </div>

            </div>


            <div class="infobox mb-4"> Attract more customers with announcements! Give them a reason to visit and keep coming back when your business is slow.</div>
            <?php if (!empty($announcements_total_count)) { ?>

              <table class="table table-light">
                <thead>
                  <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Stop Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($announcements as $key => $announcement) { ?>
                    <tr>
                      <td class="align-middle text-text-graylt"><?= $startCount++ ?></td>
                      <td class="align-middle text-text-graylt">
                        <small class="d-block"><?= $announcement->title ?></small>
                      </td>
                      <td class="align-middle text-secondary small">
                        <!-- <span class="fas fa-chair mr-2"></span> -->
                        <?= $this->Custom->readableTimestamp2($announcement->start_date) ?>
                      </td>
                      <td class="align-middle text-secondary small">
                        <!-- <span class="far fa-eye mr-2"></span> -->
                        <?= $this->Custom->readableTimestamp2($announcement->stop_date) ?>
                      </td>
                      <td scope="row" class="align-middle">
                        <?php if ($announcement->active) { ?>
                          <span class="badge badge-success">Active</span>
                        <?php } else { ?>
                          <span class="badge badge-danger">Paused</span>
                        <?php } ?>

                      </td>

                      <td class="align-middle">

                        <?= $this->Form->postLink(__(' <span class="fas fa-play btn-icon__inner"></span>'), ['action' => 'activateAnnouncement', $announcement->id], ['confirm' => __('Are you sure you want to activate # {0}?', $announcement->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Activate", 'class' => 'btn btn-xs btn-icon btn-soft-success', 'escape' => false]) ?>

                        <?= $this->Form->postLink(__(' <span class="fas fa-ban btn-icon__inner"></span>'), ['action' => 'pauseAnnouncement', $announcement->id], ['confirm' => __('Are you sure you want to pause # {0}?', $announcement->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Pause", 'class' => 'btn btn-xs btn-icon btn-soft-danger', 'escape' => false]) ?>


                        <a class="btn btn-xs btn-icon btn-soft-secondary" href="<?= $this->Url->build(['action' => 'editAnnouncement', $announcement->id]); ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                          <span class="fas fa-pen btn-icon__inner"></span>
                        </a>
                        <?= $this->Form->postLink(__(' <span class="fas fa-trash-alt btn-icon__inner"></span>'), ['action' => 'deleteAnnouncement', $announcement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $announcement->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete", 'class' => 'btn btn-xs btn-icon btn-soft-secondary', 'escape' => false]) ?>
                        <!-- <a class="btn btn-xs btn-icon btn-soft-secondary" href="javascript:;" data-toggle="tooltip" data-placement="top" title="Delete">
                        <span class="fas fa-trash-alt btn-icon__inner"></span>
                      </a> -->
                      </td>
                    </tr>

                  <?php } ?>

                </tbody>
              </table>

              <br>

              <?php if ($showAnnouncementsPagination) { ?>
                <?= $this->element('pagination_block', ['recordname' => "announcements", 'model' => 'Announcements', 'showPageBool' => $showAnnouncementsPagination]) ?>

              <?php } ?>

            <?php } else { ?>
              <!-- <div class="col-md-12"> -->

              <div class="card pt-3 mb-4 text-center pb-4 ">
                <i class="fas fa-images fa-3x"></i>
                <h5>
                  <h4 class="bold">
                    You haven't added any announcements yet</h4>
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