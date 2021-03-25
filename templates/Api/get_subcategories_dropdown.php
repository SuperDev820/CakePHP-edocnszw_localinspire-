<?php $this->disableAutoLayout(); ?>
<label class="bold" for="subcategories._ids">Sub Categories</label>
<?= $this->Form->control('subcategories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $subcategories, 'empty' => true, 'label' => false, 'class' => 'form-control subcategories_select', "style" => "width: 100%", "multiple", 'default' => isset($selected_subcategories) ? $selected_subcategories : null]); ?>
<span class="help" id=""></span>