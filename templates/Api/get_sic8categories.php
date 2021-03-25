<?php $this->disableAutoLayout(); ?>
<div class="row">
    <div class="col-md-12 form-group">
        <label class="bold" for="sic8category_id">SIC8 Category <span class="text-danger">*</span></label>
        <?= $this->Form->control('sic8category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic8categories, 'empty' => true, 'label' => false, 'id' => 'sic8category_id', 'required', 'class' => 'form-control select2', "style" => "width: 100%", 'default' => $business->sic8category_id ?? null]); ?>
        <span class="help" id=""></span>
    </div>
</div>