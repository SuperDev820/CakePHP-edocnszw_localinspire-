<?php $this->assign('title', 'My Reviews'); ?>
<style>
    #review_table thead th {
        vertical-align: middle;
        border-bottom: 1px solid #e7eaf3 !important;
        text-align: center;
    }

    #review_table td {
        text-align: center;
    }
</style>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>

            <div class="card p-4">
                <div class="row">
                    <div class="col-9">
                        <h4 class="h4 mb-0">Reviews <span class="text-muted font-size-1">(<?= $review_total_count ?>)</span></h4>
                    </div>
                </div>
                <!-- Filters -->
                <div class="row mx-gutters-2">
                    <div class="col-md-12">
                        <div class="container_nav">
                            <div class="dropdown2">
                                <button class="dropbtn2">Sort by: <b id="selected_filter_order"><?= $this->Custom->getReviewsSortText() ?></b> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                <div class="dropdown-content2">
                                    <div class="triangle-border top">
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'replies', 'addQueryKey') ?>" class="review_order" data-v="reply">
                                            <span title="Recent Answered">Owner Reply</span>
                                        </a>
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'recent', 'addQueryKey') ?>" class="review_order" data-v="new">
                                            <span title="Newest First">Newest First</span>
                                        </a>
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'oldest', 'addQueryKey') ?>" class="review_order" data-v="new">
                                            <span title="Oldest First">Oldest First</span>
                                        </a>
                                        <!--                                    <a href="javascript:;" class="review_order" data-v="old">-->
                                        <!--                                        <span title="Oldest First">Oldest First</span>-->
                                        <!--                                    </a>-->
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'helpful', 'addQueryKey') ?>" class="review_order" data-v="most">
                                            <span title="Most Answered">Most Helpful</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="dropdown2">
                            <button class="dropbtn2">Places <i class="fa fa-caret-down" aria-hidden="true"></i> </button>
                            <div class="dropdown-content2">
                                <div class="triangle-border top"> <a href=""><span title="All Categories">Panda Express</span></a> <a href=""><span title="Restaurants">The Steak House</span></a> <a href=""> <span title="lodging">Carmonas</span> </a> </div>
                            </div>
                        </div>-->
                            <!-- <div class="dropdown2">
                            <button class="dropbtn2">Terrell, Tx <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                            <div class="dropdown-content2">
                                <div class="triangle-border top"> <a href=""> <span title="Kansas City, MO">Kansas City, MO</span> <span title="(161)">(11)</span></a> <a href=""> <span title="Kansas City, KS">Kansas City, KS</span> <span title="(19)">(9)</span></a> <a href=""> <span title="Overland Park">Overland Park</span> <span title="(16)">(1)</span></a> </div>
                            </div>
                        </div>-->
                        </div>
                        <div style="clear: both;"></div>

                        <!-- End Filters -->

                        <table class="table table-light txt-12" id="review_table">
                            <thead>
                                <tr>
                                    <!--- <th scope="col" style="width: 8%;">#</th>--->
                                    <th scope="col" class="text-left">Business</th>
                                    <th scope="col">Review Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reviews as $key => $review) : ?>

                                    <tr>
                                       <!--- <td scope="row">
                                            <span class="btn btn-sm btn-icon btn-soft-secondary rounded-circle mr-2">
                                                <span class="btn-icon__inner font-weight-medium"><?= $startCount++ ?></span>
                                            </span>
                                        </td> --->
                                        <td style="text-align: left;">
                                            <div class="media "><span class="mr-2"><img style="border-radius:5%;width:45px;height:45px" class="img-fluid " src="<?= $this->Custom->getBusinessPhotoUrl($review->business) ?>" alt="Image Description"></span><span><a class="h6 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->business->id]); ?>"> <?php echo $review->business->name; ?></a><br><span class="txt-12lt"><?= $review->business->city->name; ?>, <?= strtoupper($review->business->city->state->code); ?> - <?= $review->business->zip ?></span></span></div>
                                        </td>
                                        <td class="align-middle txt-12lt text-secondary"><?= $this->Custom->niceDateMonthDayYear($review->created) ?></td>
                                        <td class="align-middle">
                                            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]); ?>" class="btn btn-xs btn-light">View</a>
                                            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'editReview', \Cake\Utility\Text::slug(strtolower($review->business->name)), strtolower($review->business->city->name), $review->business->city->state->code, $review->id]); ?>" class="btn btn-xs btn-primary">Update </a>
                                            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'deleteReview', $review->id]); ?>" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger">Delete </a>
                                        </td>
                                    </tr>


                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pt-1 pb-1 mt-1 px-1">

                            <!-- End Review Details -->
                            <?= $this->element('pagination_block', ['model' => 'BusinessReviews', 'showPageBool' => $showPagination]) ?>

                        </div>
                    </div>
                </div>
                <!-- <a class="btn btn-block btn-soft-primary transition-3d-hover r_see_more" href="javascript:;">See More</a> -->
            </div>
        </div>
    </main>
</div>
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!-- End Content Section -->


<!-- ========== END MAIN ========== -->





<script>
    $(document).ready(function() {
        // reviewlist();
        // $('.r_see_more').click(function() {
        //     page++;

        //     reviewlist();
        // })
        // $('.review_order').click(function() {
        //     order = $(this).data('v');
        //     $("#review_table tr").remove();
        //     $('#selected_filter_order').text($(this).find('span').text());
        //     page = 1;
        //     reviewlist();
        // });

    })
</script>