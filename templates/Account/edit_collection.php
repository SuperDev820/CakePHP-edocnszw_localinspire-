<?php $this->assign('title', 'Edit Collection'); ?>
<!-- Content Section -->
<div class="bg-light">
    <div class="container space-2">
        <?= $this->element('accountsidenav') ?>


        <div class="card p-5">
            <h4> Edit Collection</h4>
            <hr class="">
            <?php echo $this->Form->create($collection, ['class' => 'js-validate', 'enctype' => 'multipart/form-data', 'id' => '']) ?>

            <?= $this->element('collection_form') ?>

            <button type="submit" class="btn bold btn-sm btn-primary mr-1">Update</button>

            <!-- <?= $this->Form->button(__('Update'), ['class' => '"btn bold btn-sm btn-primary mr-1']); ?> -->

            <?= $this->Form->end() ?>
            <!-- End Social Profiles Form -->
        </div>
    </div>
</div>
<!-- End Content Section -->
<!-- </main> -->