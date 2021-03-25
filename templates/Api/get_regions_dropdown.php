<?php $this->disableAutoLayout();?>
<div class="checkout-form-list mb-30">
    <label>Region
        <span class="required">*</span>
    </label>
    <?=$this->Form->control('region_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $regions, 'empty' => true, 'label' => false, 'class' => 'region_select select2select', "default" => $region_id, "style" => "width: 100%", 'required']);?>
</div>
