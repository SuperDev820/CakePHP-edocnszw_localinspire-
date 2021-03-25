<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/infinite-scroll.pkgd.js"></script>
<div class="followers_list row" id="followers_list">
    <?= $this->element('account_followers', ['following' => $following]) ?>
</div>
<?php if ($showFPagination) { ?>

    <!-- status elements -->
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

<script>
    $(document).on('ready', function() {
        // load_followers_list("AZ", 0);
        // $('select[name=filters]').change(function() {
        //     var order = $(this).val();
        //     $('.followers_list').html("");
        //     $("#view_more_link").data('more', 1);
        //     load_followers_list(order, 0);
        // })



        <?php if ($showFPagination) { ?>

            var infScroll = new InfiniteScroll('#followers_list', {
                // debug: true,
                path: '.next_page',
                append: ".one-follower",
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

        })


        // initialization of autonomous popups
        $.SRCore.components.SRModalWindow.init('[data-modal-target]', '.js-modal-window', {
            autonomous: true
        });


        // initialization of horizontal progress bars
        var horizontalProgressBars = $.SRCore.components.SRProgressBar.init('.js-hr-progress', {
            direction: 'horizontal',
            indicatorSelector: '.js-hr-progress-bar'
        });

        var verticalProgressBars = $.SRCore.components.SRProgressBar.init('.js-vr-progress', {
            direction: 'vertical',
            indicatorSelector: '.js-vr-progress-bar'
        });


    });
</script>