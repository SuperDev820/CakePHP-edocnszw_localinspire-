<?php $this->disableAutoLayout();?>

<div class="form-group row">
    <label class="col-md-3 label-control" for="subsubcategories._ids">Sub Sub Categories
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <?=$this->Form->control('subsubcategories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $subsubcategories, 'empty' => true, 'label' => false, 'class' => 'form-control select2_multiple subsubcategories_select', "style" => "width: 100%", "multiple", 'default' => $selected_subsubcategories]);?>
    </div>
</div>
