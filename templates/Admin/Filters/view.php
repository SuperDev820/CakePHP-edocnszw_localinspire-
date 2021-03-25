<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $filter
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Filter'), ['action' => 'edit', $filter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Filter'), ['action' => 'delete', $filter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Filters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Filter'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="filters view large-9 medium-8 columns content">
    <h3><?= h($filter->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($filter->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($filter->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Input Type') ?></th>
            <td><?= h($filter->input_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Input Class') ?></th>
            <td><?= h($filter->input_class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Placeholder') ?></th>
            <td><?= h($filter->placeholder) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($filter->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Search Keyword Id') ?></th>
            <td><?= $this->Number->format($filter->search_keyword_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Id') ?></th>
            <td><?= $this->Number->format($filter->category_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Key Order') ?></th>
            <td><?= $this->Number->format($filter->key_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Type Id') ?></th>
            <td><?= $this->Number->format($filter->form_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Show Business') ?></th>
            <td><?= $filter->show_business ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $filter->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Options') ?></h4>
        <?= $this->Text->autoParagraph(h($filter->options)); ?>
    </div>
</div>
