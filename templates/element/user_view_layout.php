<?php $this->assign('title', $user->name_desc . " Reviews, Photos and More "); ?>

<?= $this->element('profilenav', ['user' => $user]) ?>
<!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/jquery.infiniteScroll.js"></script> -->
<!-- <script src="<?= $this->Url->build('/plugins/infinite-scroll/jquery.infiniteScroll.js', ['fullBase' => true]); ?>"></script> -->
<!-- <script src="<?= $this->Url->build('/plugins/infinite-scroll/infinite-scroll.pkgd.js', ['fullBase' => true]); ?>"></script> -->

<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/infinite-scroll.pkgd.js"></script>

<?= $this->element('user_profile_css') ?>

<!-- Content Section -->
<section class="bg-light">
    <main>
        <?php if (!$userBlockedMe) {  ?>

            <div class="container space-top-1">
                <div class="row">
                    <div class="col-lg-3 mb-7 mb-lg-0 profilesidebar">
                        <?= $this->element('profilesidebar', ['user' => $user]) ?>

                    </div>
                    <div class="col-lg-6">

                        <?= $this->fetch('tab_content') ?>


                        <!-- Review Details -->
                        <div class="reviews" id="user_activities">
                            <?php echo $this->element('user_activities', ['activitiesArray' => $activitiesArray, 'activities_total_count' => $activities_total_count]) ?>
                        </div>
                        <!-- End Review Details -->

                        <?php if ($showActivitiesPagination) { ?>

                            <!-- status elements -->
                            <div class="scroller-status">
                                <div class="infinite-scroll-request loader-ellips" style="text-align:center; margin-bottom:30px;">
                                    <!---<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
</div>---><div style="text-align:center; margin-left:250px; margin-bottom:30px;" class="loader  quantum-spinner"></div>


                                </div>
                                <!-- <p class="infinite-scroll-last">End of content</p> -->
                                <!-- <p class="infinite-scroll-error">No more pages to load</p> -->
                            </div>


                            <?= $this->element('pagination_block', ['model' => 'UserActivities', 'showPageBool' => $showActivitiesPagination]) ?>

                        <?php } ?>


                        <!-- <div class="text-center mb-4">
                            <a class="btn btn-soft-primary mt-4 show_more" href="javascript:get_reviews()">Show More <i class="fas ml-2 fa-chevron-down"></i></a>
                        </div> -->

                    </div>

                    <?= $this->element('rightprofilesidebar', ['user' => $user, 'followers' => $followers]) ?>

                </div>
            </div>

        <?php } else { ?>
            <div class="bg-light">
                <div class="container space-top-1">
                    <div class="row bold">
                        <p style="color:red !important; text-align:center !important; width:100%; margin: 60px;"> This users profile is not available. </p>
                    </div>
                </div>
            </div>

        <?php } ?>
    </main>
</section>




<!-- End Content Section -->
<!-- Report Review Modal Window -->
<?= $this->element('report_review_modal') ?>
<!-- End Report Review Modal Window -->
<!-- Report Success Modal Window -->
<?= $this->element("success_modal") ?>


<!-- Share Review Modal Window -->
<?= $this->element('share_review_modal') ?>
<!-- End Share Review Modal Window -->

<!-- Report Owner Modal Window -->
<?= $this->element('report_owner_modal') ?>
<!-- End Report Owner Modal Window -->
<!-- Report Photos Modal Window -->
<?= $this->element('report_photo_modal') ?>
<!-- End Report Photos Modal Window -->


<?php if ($showActivitiesPagination) { ?>

    <script>
        $(function() {

            // https://github.com/metafizzy/infinite-scroll

            var infScroll = new InfiniteScroll('#user_activities', {
                // debug: true,
                path: '.next_page',
                append: ".activity_content",
                hideNav: ".pagination_container",
                status: '.scroller-status',
                dataType: 'html',
                loading: {
                    finishedMsg: 'No more posts to load!',
                    img: "<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>"
                }
            });

            // $('.paging-description').hide();
        });
    </script>
<?php } ?>


<script>
    $(function() {
        // var $container = $('#user_activities');

        // $container.infinitescroll({
        //     navSelector: '.paging', // selector for the paged navigation
        //     nextSelector: '.next a', // selector for the NEXT link (to page 2)
        //     itemSelector: '.country-item', // selector for all items you'll retrieve
        //     debug: true,
        //     dataType: 'html',
        //     loading: {
        //         finishedMsg: 'No more posts to load!',
        //         img: 'http://miftyisbored.com/wp-tutorials/cakephp-infinite-scroll/img/spinner.gif'
        //     }
        // });

        // $('.paging-description').hide();
    });


    var page = 1;
    var $methods = $('.reviews');

    function get_reviews() {
        $.ajax({
            type: "post",
            url: 'profile/get_ajax_user_activity',
            data: {
                page: page,
                uid: ""
            },
            success: function(data) {
                console.log(data);
                // $('.reviews').html(data);

                $('.reviews').append(data);
                $.SRCore.components.SRUnfold.init($('.reviews [data-unfold-target]'));
                // $('.reviews').data('lightGallery').destroy(true);
                page++;


            },
            error: function() {
                console.log(error);
            }
        });
    }


    $(document).ready(function() {

        // $(window).bind('scroll.posts', scrollEvent);


        // get_reviews();
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>