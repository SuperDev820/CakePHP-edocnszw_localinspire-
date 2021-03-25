<div id="searchFilterModal" class="js-modal-window u-modal-window" style="width: calc(100% - 30px)!important;">
    <div class="card">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0"> Filters
                    <!--Cuisines & Dishes-->
                </h3>
                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.closeAll(); rmjs.destroy();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
            <?php $filterChunks = array_chunk($filters, $chunksize, true); ?>
            <div class="mt-2" id="filter_collapse">

                <!--   filter_out_container  js-scrollbar  -->
                <div class="container col-lg-12 col-md-12 col-12">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $this->element('grid_block', ['chunk' => $filterChunks[0]]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->element('grid_block', ['chunk' => $filterChunks[1]]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->element('grid_block', ['chunk' => $filterChunks[2]]) ?>
                        </div>
                    </div>


                </div>
                <!-- <div class="container"> -->
                <!-- <div class="row">
                    <div class="col-sm-12">
                        <div class="custom-control custom-checkbox">
                            <a href="#searchFilterModal" data-modal-target="#searchFilterModal">More Options</a>
                        </div>
                    </div>
                </div> -->
                <!-- </div> -->


                <form action="<?= $this->Url->build('/', ['fullBase' => true]); ?>search" method="GET" id="researchform">

                    <input type="hidden" name="find" value="<?= $search_term ?>" />
                    <input type="hidden" name="loc" value="<?= (!empty($city) ? $city->name . "-" . strtoupper($city->state->code) : '') ?>" />
                    <input type="hidden" name="filters" value="" />
                    <input type="hidden" name="radius" value="<?= $radius ?>" />
                    <div>
                        <button type="submit" class="btn btn-primary bold btn-block"><i class="fas fa-search mr-2"></i>Search Again</button>

                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- End Body -->
</div>