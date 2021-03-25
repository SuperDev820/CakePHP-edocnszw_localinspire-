<?php $this->assign('title', 'My Notifications'); ?>
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/infinite-scroll.pkgd.js"></script>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>

            <div class="card p-4">
                <div class="row pb-3 mb-3 border-bottom">
                    <div class="col-9">
                        <h4 class="h4 mb-0"><b>Notifications</b> <span class="text-muted font-size-1">(<?= $unread_count ?> unread)</span></h4>
                    </div>
                    <div class="col-3 text-right  txt-14">
                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'markAllAsRead']); ?>">Mark all as read</a>
                    </div>
                </div>
                <!-- Filters -->
                <div class="row mx-gutters-2">
                    <div class="col-md-12">
                        <div class="" id="user_notifications">
                            <?= $this->element('notification_block', ['notifications' => $notifications, 'notifications_total_count' => $notifications_total_count]) ?>
                        </div>

                        <?php if ($showNotificationPagination) { ?>
                            <div class="pt-1 pb-1 mt-1 px-1">
                                <div class="scroller-status">
                                    <div class="infinite-scroll-request loader-ellips" style="text-align:center; margin-bottom:30px;">
                                        <img src="<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>" alt="" srcset="">
                                    </div>
                                    <!-- <p class="infinite-scroll-last">End of content</p> -->
                                    <!-- <p class="infinite-scroll-error">No more pages to load</p> -->
                                </div>
                                <?php echo $this->element('pagination_block', ['model' => 'Notifications', 'showPageBool' => $showNotificationPagination, 'recordname' => 'notifications']) ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- <a class="btn btn-block btn-soft-primary transition-3d-hover r_see_more" href="javascript:;">See More</a> -->
            </div>
        </div>
    </main>
</div>


<!-- ========== END MAIN ========== -->



<?php if ($showNotificationPagination) { ?>

    <script>
        $(function() {

            // https://github.com/metafizzy/infinite-scroll

            var infScroll = new InfiniteScroll('#user_notifications', {
                // debug: true,
                path: '.next_page',
                append: ".notification_content",
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