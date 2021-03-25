<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/infinite-scroll.pkgd.js"></script>
<style>
    select {
        background-color: transparent;
        border: none;
        color: black;
        font-size: 13px;
    }
</style>



<div class="bg-light">
    <div class="container space-top-1">
        <div class="row">
            <div class="col-lg-3 mb-7 mb-lg-0 profilesidebar">
                <?= $this->element('profilesidebar', ['user' => $user]) ?>
            </div>

            <div class="col-lg-9">

                <div class="row justify-content-between align-items-center mb-4">
                    <!-- Title -->
                    <div class="col-sm-4 col-md-6 mb-3 mb-sm-0">

                        <?php if ($show_following) { ?>
                            <h2 class="h4 mb-0">Following</h2>
                        <?php } else { ?>
                            <h2 class="h4 mb-0">Followers</h2>
                        <?php } ?>

                    </div>
                    <!-- End Title -->

                    <!-- Filter -->
                    <div class="col-sm-8 col-md-6 text-sm-right">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item">

                            <li class="list-inline-item small">
                                Sort by: &nbsp;&nbsp;<select name="filters" class="filters" id="followers_filters">
                                    <option value="a-z">Alphabetical A-Z</option>
                                    <option value="active" <?= $this->Custom->queryHasKey('sort', 'active') ? 'selected="selected"' : '' ?>>Recenyly Active</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <!-- End Filter -->
                </div>

                <div class="followers_following_list row" id="followers_following_list">

                    <?php echo $this->element('user_followers_following', ['user_followers_following' => $user_followers_following, 'total_f_count' => $total_f_count, 'show_following' => $show_following]) ?>
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <?php if ($showFPagination) { ?>

                            <!-- status elements -->
                            <div class="scroller-status">
                                <div class="infinite-scroll-request loader-ellips" style="text-align:center; margin-bottom:30px;">
                                    <img src="<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>" alt="" srcset="">
                                </div>
                                <!-- <p class="infinite-scroll-last">End of content</p> -->
                                <!-- <p class="infinite-scroll-error">No more pages to load</p> -->
                            </div>


                            <?= $this->element('pagination_block', ['model' => 'Followers', 'showPageBool' => $showFPagination]) ?>

                        <?php } ?>

                    </div>
                </div>


                <!-- <center class="view_more_container" style="display:none">
                    <div class="mt-4">
                        <a class="btn btn-sm btn-primary" id="view_more_link" href="javascript:view_more();" data-more="1">

                            View More &nbsp;&nbsp;<i class="fas fa-chevron-down"></i>
                        </a>
                    </div>
                </center> -->

            </div>
            <!-- End Content Section -->
        </div>
    </div>
</div>
</main>

<!-- Report profile Modal Window -->
<?= $this->element('report_profile_modal', ['user' => $user]) ?>
<!-- End Report Profile Modal Window -->

<script>
    $(document).ready(function() {

        <?php if ($showFPagination) { ?>

            var infScroll = new InfiniteScroll('#followers_following_list', {
                // debug: true,
                path: '.next_page',
                append: ".f_content",
                hideNav: ".pagination_container",
                status: '.scroller-status',
                dataType: 'html',
                loading: {
                    finishedMsg: 'No more posts to load!',
                    img: "<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>"
                }
            });

        <?php } ?>

        $('select[name=filters]').change(function() {
            var sort = $(this).val();
            var hrefUrl = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
            // var page = getParameterByName('page', hrefUrl);
            hrefUrl = updateQueryString('sort', sort, hrefUrl);
            window.location.href = hrefUrl;

            // $('.followers_following_list').html("");
            // $("#view_more_link").data('more', 1);
            // console.log(order);
            // load_followers_following_list(MID, order, 0);
        })
    })
</script>