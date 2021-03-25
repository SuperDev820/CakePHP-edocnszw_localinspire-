<?php $this->disableAutoLayout();?>

<div class="form-group row">
    <label class="col-md-3 label-control" for="subcategory_id">Sub Categories
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <?=$this->Form->control('subcategory_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $subcategories, 'empty' => true, 'label' => false, 'class' => 'form-control subcat_select', "style" => "width: 100%", 'default' => $selected_subcategory]);?>
    </div>
</div>
