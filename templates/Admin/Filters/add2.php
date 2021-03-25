<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $filter
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Filters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="filters form large-9 medium-8 columns content">
    <?= $this->Form->create($filter) ?>
    <fieldset>
        <legend><?= __('Add Filter') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('search_keyword_id');
            echo $this->Form->control('category_id');
            echo $this->Form->control('key_order');
            echo $this->Form->control('form_type_id');
            echo $this->Form->control('input_type');
            echo $this->Form->control('input_class');
            echo $this->Form->control('placeholder');
            echo $this->Form->control('show_business');
            echo $this->Form->control('active');
            echo $this->Form->control('options');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
