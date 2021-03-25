<?php $this->assign('title', 'Stories in ' . (!empty($city) ? $city->name . ", " . strtoupper($city->state->code) : '')); ?>

<main id="content" role="main">
    <!-- Blog Classic Section -->
    <div class="container space-2 space-top-md-2 space-top-lg-1">
        <!-- Title -->
        <div class="w-md-80 w-lg-60 mb-9">
            <h1 class="font-weight-normal">Stories in <span class="text-primary font-weight-semi-bold"><?= (!empty($city) ? $city->name . ", " . strtoupper($city->state->code) : '') ?></span> <?= (!empty($view_tag) ? "tagged " . ucwords($view_tag->name) : '') ?></h1>
        </div>
        <!-- End Title -->

        <?php if (!empty($posts_total_count)) { ?>

            <div class="row">
                <div class="col-lg-9 mb-9 mb-lg-0">
                    <?php foreach (array_chunk($posts->toArray(), 2) as $values) { ?>
                        <div class="card-deck d-block d-sm-flex card-sm-gutters-3 mb-sm-7">
                            <?= $this->element('posts_block', ['post' => $values[0]]) ?>
                            <?= $this->element('posts_block', ['post' => !empty($values[1]) ? $values[1] : null]) ?>
                        </div>
                    <?php } ?>



                    <div class="space-bottom-2"></div>

                    <?php if ($showPostsPagination) : ?>
                        <?php $this->Paginator->setTemplates($this->Custom->paginatorTemplatesFrontend(((isset($tips) and $tips == true) ? "tipslink" : 'reviewpagelink'))); ?>
                        <nav class="card d-flex justify-content-center pt-3 mt-3 mb-3">
                            <ul id="review_pagination" class="pagination pl-5">
                                <?= $this->Paginator->first('<< ' . __('First'), ['model' => 'Posts']) ?>
                                <?= $this->Paginator->prev('< ' . __('Previous'), ['model' => 'Posts']) ?>
                                <?= $this->Paginator->numbers(['model' => 'Posts']) ?>
                                <?= $this->Paginator->next(__('Next') . ' >', ['model' => 'Posts']) ?>
                                <?= $this->Paginator->last(__('Last') . ' >>', ['model' => 'Posts']) ?>
                            </ul>

                            <p class="text-muted pl-5"><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} posts(s) out of {{count}} total') ?></p>
                        </nav>
                    <?php endif; ?>

                    <!-- End Pagination -->
                </div>

                <div id="stickyBlockStartPoint" class="col-lg-3">
                    <?= $this->element('stories_sidebar') ?>
                </div>
            </div>


        <?php } else { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row align-items-center  text-center">
                        <div class="col-md-12 mt-5 text-center">
                            <div class="title-box">
                                <h2 class="title-light text-dark">Nothing to show here <span>for now..</span></h2>
                            </div>

                            <img class="img-fluid top-img1 w-100" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>img/screen-1.png" alt="image" style="max-width: 400px;">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- End Blog Classic Section -->

    <!-- Sticky Block End Point -->
    <div id="stickyBlockEndPoint"></div>

    <!-- Subscribe Section -->

    <!-- End Subscribe Section -->
</main>