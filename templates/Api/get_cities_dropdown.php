<?php $this->disableAutoLayout(); ?>
<div class="js-form-message">
    <label id="organizationLabel" class="txt-14 bold mb-2">
        City <span class="text-danger">*</span>
    </label>
    <div class="form-group">
        <?= $this->Form->control('city_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $cities, 'empty' => true, 'label' => false, "id" => "city_id", 'class' => 'select2 city_select form-control', "style" => "width: 100%", 'required', 'default' => $city_id]); ?>
    </div>
</div>

<style>
  }
  .city_select {
    display: block;
  width: 100%;
  height: calc(3rem + 0px) !important;
  padding: 0.65rem 1rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #1e2022;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #d5dae2;
  border-radius: 0.25rem;
  </style>