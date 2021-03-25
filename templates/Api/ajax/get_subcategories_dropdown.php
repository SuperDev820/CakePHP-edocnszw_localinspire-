<?php $this->disableAutoLayout();?>

<div class="form-group row">
    <label class="col-md-3 label-control" for="subcategories._ids">Sub Categories
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <?=$this->Form->control('subcategories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $subcategories, 'empty' => true, 'label' => false, 'class' => 'form-control select2_multiple subcategories_select', "style" => "width: 100%", "multiple", 'default' => $selected_subcategories]);?>
    </div>
</div>
