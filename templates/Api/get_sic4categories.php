<?php $this->disableAutoLayout(); ?>
<div class="row">
    <div class="col-md-12 form-group">
        <label class="bold" for="sic4category_id">SIC4 Category <span class="text-danger">*</span></label>
        <?= $this->Form->control('sic4category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic4categories, 'empty' => true, 'label' => false, 'id' => 'sic4category_id', 'required', 'class' => 'form-control select2', "style" => "width: 100%", 'default' => $business->sic4category_id ?? null]); ?>
        <span class="help" id=""></span>
    </div>
</div>
