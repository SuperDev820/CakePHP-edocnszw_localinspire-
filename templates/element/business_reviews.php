<?php if (!empty($reviewsArray)) : ?>
    <?php foreach ($reviewsArray as $index => $review) : ?>

        <?php if (isset($tips) and $tips == true) : ?>
            <div class="card pt-3 mt-4 px-4 mb-4">
                <?= $this->element('review_author', ['review' => $review, 'tips' => $tips]) ?>
                <!-- End Author -->

                <div class="mt-3 txt-14 mb-1">
                    "<?= $review->advice ?>" </div><div class="mb-2"><a class="text-dark mb-4 mt-3" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'userReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $review->id]); ?>"><span class="bold txt-12">Read full review!</span></a>

                </div>
            </div>
        <?php else : ?>
            <?= $this->element('review_block', ['review' => $review]) ?>
        <?php endif; ?>

    <?php endforeach; ?>
    <?php if ($showPagination) : ?>
        <?php $this->Paginator->setTemplates($this->Custom->paginatorTemplatesFrontend(((isset($tips) and $tips == true) ? "tipslink" : 'reviewpagelink'))); ?>
        <nav class="card d-flex justify-content-center pt-3 mt-3 mb-3">
            <ul id="review_pagination" class="pagination pl-5">
                <?= $this->Paginator->first('<< ' . __('First'), ['model' => 'BusinessReviews']) ?>
                <?= $this->Paginator->prev('< ' . __('Previous'), ['model' => 'BusinessReviews']) ?>
                <?= $this->Paginator->numbers(['model' => 'BusinessReviews']) ?>
                <?= $this->Paginator->next(__('Next') . ' >', ['model' => 'BusinessReviews']) ?>
                <?= $this->Paginator->last(__('Last') . ' >>', ['model' => 'BusinessReviews']) ?>
            </ul>

            <p class="text-muted pl-5"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total'), 'model' => 'BusinessReviews']) ?></p>
        </nav>
    <?php endif; ?>

<?php else : ?>
    <div class="card pt-3 mt-4 mb-4 text-center pb-4 ">
        <i class="fas fa-comment-dots fa-3x"></i>
        <h5>
            <h4 class="bold">No reviews yet</h4> Write about your experience, the good, the bad, or any helpful advice for our visitors. 
            
            <div class="mt-3 font-size-1 text-center">
                                        <div class="font-size-1 bold mb-2">Do you recommend <?= ucfirst($business->name) ?>?</div>
                                        <!--<button type="button" style="width: 130px;" onClick="window.location.href='#recommendModal" data-modal-target="#recommendModal" class="btn btn-recommend btn-xs mr-2">Yes</button>-->
                                        <span class="text-dark"><button type="button" style="width: 150px;" class="btn btn-light borderlt  bold mr-2 recommendYes">Yes</button></span>
                                        <span class="text-dark"><button type="button" class="btn btn-light borderlt bold recommendNo" style="width: 150px;">No</button></span>
                                    </div>

                                
        </h5>
    </div>

<?php endif; ?>

<?= $this->element('review_scripts') ?>