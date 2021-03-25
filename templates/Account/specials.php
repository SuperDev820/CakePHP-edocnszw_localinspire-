<?php $this->assign('title', 'Special Offers'); ?>
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/infinite-scroll/infinite-scroll.pkgd.js"></script>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>

            <div class="card p-4">
                <h4 class="">Special offers</h4>
                <!-- Status -->
                <div class="row mx-gutters-2 mb-0">
                    <div class="col-6 col-sm">
                        <div class="container_nav">
                            <div class="dropdown2">
                                <button class="dropbtn2">Sort by: <b id="selected_filter_order"><?= $this->Custom->getReviewsSortText() ?></b> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                <div class="dropdown-content2">
                                    <div class="triangle-border top">

                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'recent', 'addQueryKey') ?>" class="specials_order" data-v="most">
                                            <span title="Recently Added Specials">Recently Added Specials</span>
                                        </a>
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'anniversary', 'addQueryKey') ?>" class="specials_order" data-v="reply">
                                            <span title="Anniversary Specials">Anniversary Specials</span>
                                        </a>
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'birthday', 'addQueryKey') ?>" class="specials_order" data-v="new">
                                            <span title="Birthday Specials">Birthday Specials</span>
                                        </a>

                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'collection', 'addQueryKey') ?>" class="specials_order" data-v="most">
                                            <span title="Saved Business Specials">Saved Business Specials</span>
                                        </a>
                                        <?php if (!empty($keywords)) { ?>
                                            <?php foreach ($keywords as $key => $keyword) { ?>
                                                <a href="<?= $this->Custom->getfilterUrl('sort', $keyword->name, 'addQueryKey') ?>" class="specials_order" data-v="new">
                                                    <span title="<?= $keyword->name ?>"><?= $keyword->name ?></span>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>

                                        <!-- 
                                        <a href="<?= $this->Custom->getfilterUrl('sort', 'helpful', 'addQueryKey') ?>" class="specials_order" data-v="most">
                                            <span title="Other">Other</span>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Status -->
                <hr>

                <!-- Review Details -->
                <div class="" id="user_offers">
                    <?php echo $this->element('user_offers', ['offersArray' => $offers, 'offers_total_count' => $offers_total_count]) ?>
                </div>
                <!-- End Review Details -->
                <?php $showingOffer = false; ?>
                <?php foreach ($offers as $key => $offer) { ?>
                    <?php if ($this->Custom->canShow($offer, $offer->business)) { ?>
                        <?php $showingOffer = true; ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($showOffersPagination and $showingOffer) { ?>

                    <!-- status elements -->
                    <div class="scroller-status">
                        <div class="infinite-scroll-request loader-ellips" style="text-align:center; margin-bottom:30px;">
                            <img src="<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>" alt="" srcset="">
                        </div>
                        <!-- <p class="infinite-scroll-last">End of content</p> -->
                        <!-- <p class="infinite-scroll-error">No more pages to load</p> -->
                    </div>

                    <?= $this->element('pagination_block', ['model' => 'Offers', 'showPageBool' => $showOffersPagination, 'recordname' => "offers"]) ?>

                <?php } ?>
                
            </div>
        </div>
    </main>
</div>
<!-- End Content -->


<?php if ($showOffersPagination and $showingOffer) { ?>

    <script>
        $(function() {

            // https://github.com/metafizzy/infinite-scroll

            var infScroll = new InfiniteScroll('#user_offers', {
                // debug: true,
                path: '.next_page',
                append: ".offer_content",
                hideNav: ".pagination_container",
                status: '.scroller-status',
                dataType: 'html',
                loading: {
                    finishedMsg: 'No more offers to load!',
                    img: "<?= $this->Url->build('/img/spinner.gif', ['fullBase' => true]); ?>"
                }
            });

            // $('.paging-description').hide();
        });
    </script>
<?php } ?>