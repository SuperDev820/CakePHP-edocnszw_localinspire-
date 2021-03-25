<?php $pageBool = isset($showPageBool) ? $showPageBool : $showQuestionPagination; ?>
<?php  //$pageBool = true; 
?>

<?php if ($pageBool) : ?>
    <?php
    $paginationModelToUse = !empty($model) ? $model : 'Questions';
    $linkClassToUse = !empty($linkClass) ? $linkClass : 'questionpagelink';

    ?>

    <?php $this->Paginator->options(['model' => $paginationModelToUse]); ?>
    <?php $this->Paginator->setTemplates($this->Custom->paginatorTemplatesFrontend($linkClassToUse)); ?>
    <div class="pagination_container">
        <nav class="card d-flex justify-content-center pt-3 mt-3 mb-3">
            <ul id="qa_pagination" class="pagination pl-5">
                <?= $this->Paginator->first('<< ' . __('First'), ['model' => $paginationModelToUse]) ?>
                <?= $this->Paginator->prev('< ' . __('Previous'), ['model' => $paginationModelToUse]) ?>
                <?= $this->Paginator->numbers(['model' => $paginationModelToUse]) ?>
                <?= $this->Paginator->next(__('Next') . ' >', ['model' => $paginationModelToUse]) ?>
                <?= $this->Paginator->last(__('Last') . ' >>', ['model' => $paginationModelToUse]) ?>
            </ul>

            <p class="text-muted pl-5"><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} ' . (!empty($recordname) ? $recordname : 'record(s)') . ' out of {{count}} total') ?></p>
        </nav>
    </div>
<?php endif; ?>