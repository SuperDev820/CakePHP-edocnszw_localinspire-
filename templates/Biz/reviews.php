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


            <h4 class="bold">Reviews of <?= $active_business->name ?>!</h4>
            <div class="infobox txt-14 mb-4">Let customers know that you value their opinions - and their business - by sharing thoughtful responses to feedback, thank them for visiting with you, if it's a bad review try to make things right with your customer, reviews go a long way in growing your business.</div>


            <div class="dropdown2">
              <button class="dropbtn2 txt-12">Sort by: <b id="selected_filter_order"><?= $this->Custom->getReviewsSortText() ?></b> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
              <div class="dropdown-content2">
                <div class="triangle-border top">
                  <a href="<?= $this->Custom->getfilterUrl('sort', 'recent', 'addQueryKey') ?>" class="review_order" data-v="reply">
                    <span title="Recent Answered">Most Recent</span>
                  </a>
                  <a href="<?= $this->Custom->getfilterUrl('sort', 'waiting', 'addQueryKey') ?>" class="review_order" data-v="new">
                    <span title="Newest First">Awaiting Reply</span>
                  </a>
                  <a href="<?= $this->Custom->getfilterUrl('sort', 'recommend', 'addQueryKey') ?>" class="review_order" data-v="new">
                    <span title="Oldest First">Recommends</span>
                  </a>
                  <a href="<?= $this->Custom->getfilterUrl('sort', 'helpful', 'addQueryKey') ?>" class="review_order" data-v="most">
                    <span title="Most Answered">Most Helpful</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="table-responsive-sm">
              <table class="table table-light">
                <thead>
                  <tr>
                   
                    <th scope="col" class="txt-12 bold">Reviewer</th>
                    <th scope="col" class="text-center txt-12 bold">Title</th>
                    <th scope="col" class="text-center txt-12 bold">Recommends</th>
                    <th scope="col" class="text-center txt-12 bold">Review date</th>
                    <th scope="col" class="text-center txt-12 bold">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($reviews as $key => $review) { ?>

                    <tr>
                    
                      <td class="align-middle">
                        <div class="media align-items-center">
                          <a class="position-relative mr-3" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>">
                            <img class="u-sm-avatar border rounded-circle" src="<?= !empty($review->user) ?  $this->Custom->getDp($review->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="<?= $review->user->name_desc ?>">
                          </a>
                          <div class="media-body">
                            <h3 class="h6 mb-0 bold">
                              <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= $review->user->name_desc ?></a>
                            </h3>
                            <small class="d-block txt-12 text-secondary"><?= !empty($review->user->city) ? $review->user->city->name . ", " . strtoupper($review->user->city->state->code) : ""; ?></small>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-primary txt-12 text-center">
                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]); ?>"><?= $review->title ?></a>
                        <?php if ($review->featured) { ?>
                          <span class="badge badge-success txt-14">Featured</span>
                        <?php } ?>
                      </td>
                      <td class="align-middle text-primary txt-14 text-center">
                        <?php if ($review->recommend) { ?>
                          <span class="badge badge-success">YES</span>
                        <?php } else { ?>
                          <span class="badge badge-danger">NO</span>
                        <?php } ?>
                      </td>
                      <td class="align-middle text-secondary txt-12 text-center"> <?= $this->Custom->niceDateMonthDayYear($review->created) ?></td>

                      <td class="align-middle text-center">

                        <div class="btn-group btn-group-vertical">
                          <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]); ?>" class="btn btn-xs bold btn-primary mb-1">View review</a>
                          <?php if ($review->business->enhanced) { ?>
                            <a class="txt-12 bold btn btn-xs btn-primary mb-1 sendmessage" data-business_id="<?= $review->business_id ?>" data-review_id="<?= $review->id ?>" data-receieverid="<?= $review->user->id ?>" data-receievername="<?= ucwords($review->user->name_desc) ?>" href="javascript:;">
                              <span class="fa fa-comment text-black-50 txt-14 mr-1"></span> Send Private Message
                            </a>
                          <?php } ?>
                          <?php //echo $this->Form->postLink(__('Feature this review'), ['action' => 'featureReview', $review->id], ['confirm' => __('Are you sure you want to feature this review?', $review->id), "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Set as featured", 'class' => 'btn btn-xs bold btn-primary', 'escape' => false]) 
                          ?>
                        </div>

                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="pt-1 pb-1 mt-1 px-1">

                <!-- End Review Details -->
                <?= $this->element('pagination_block', ['model' => 'BusinessReviews', 'showPageBool' => $showPagination]) ?>

              </div>
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