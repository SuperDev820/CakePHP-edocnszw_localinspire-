<?php $this->disableAutoLayout();?>
<div class="checkout-form-list mb-30">
    <label>LGA / Region
        <span class="required">*</span>
    </label>
    <?=$this->Form->control('lga_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $lgas, 'empty' => true, 'label' => false, 'class' => 'lga_select select2select', "default" => $lga_id, "style" => "width: 100%", 'required']);?>
</div>
