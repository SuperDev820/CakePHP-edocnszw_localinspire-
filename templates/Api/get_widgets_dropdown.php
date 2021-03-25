<?php $this->disableAutoLayout(); ?>
<div class="form-group">
    <label class="label-control" for="widget_id"> Widgets
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="">
        <?= $this->Form->control('widget_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $widgets, 'empty' => false, 'label' => false, 'class' => 'form-control widget_select', 'id' => 'widget_id', "style" => "width: 100%", 'default' => !empty($selected_widget) ? $selected_widget->id : '']); ?>
    </div>
</div>